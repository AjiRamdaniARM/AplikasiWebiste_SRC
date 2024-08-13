<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\UserRequest as AdminUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with('roles');
        if ($request->ajax()) {
            return DataTables::eloquent($users)
                ->addIndexColumn()
                ->editColumn('created_at', function (User $user) {
                    return $user->created_at->format('d-m-Y');
                })
                ->addColumn('roles', function (User $user) {
                    return $user->roles->map(function ($role) {
                        return '<span class="badge badge-primary">'.$role->name.'</span>';
                    })->implode(' ');
                })
                ->addColumn('action', 'dashboard.user.action')
                ->rawColumns(['action', 'roles'])
                ->toJson();
        }

        $title = 'Delete User !!';
        $text = 'Are you sure you want to delete?';
        confirmDelete($title, $text);

        return view('dashboard.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('dashboard.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('sukarobot123'),
                'community' => $request->community,
                'pob' => $request->pob,
                'dob' => $request->dob,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);

            $user->assignRole($request->role);

            alert()->success('Success', 'Create user');

            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            alert()->error('Error', 'Failed to create user !!');

            return redirect()->route('user.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('dashboard.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('dashboard.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'community' => $request->community,
                'pob' => $request->pob,
                'dob' => $request->dob,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);

            $user->syncRoles($request->role);

            alert()->success('Success', 'Update user');

            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            alert()->error('Error', 'Failed to update user !!');

            return redirect()->route('user.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->delete();

            alert()->success('Success', 'Delete user');

            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            alert()->error('Oops !!', 'Failed delete user');

            return redirect()->route('user.index');
        }
    }
}
