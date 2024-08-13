<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(UserRequest $request)
    {
        $messages = [
            'email.unique' => 'Email nya sudah terdaftar!!',
            'phone.unique' => 'Nomor Telephone nya sudah terdaftar!!n.',
            // Add custom messages for other fields if needed
        ];

        try {
            $part = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'community' => $request->community,
                'pob' => $request->pob,
                'dob' => $request->dob,
                'address' => $request->address,
                'phone' => $request->phone,
            ], $messages);

            $part->assignRole('participant');

            alert()->success('Success', 'Register account success, please login');

            return redirect()->route('login');
        } catch (\Throwable $th) {
            alert()->error('Error', 'Failed to create account. Please try againt !!');

            return redirect('/register')->withInput();
        }
    }
}
