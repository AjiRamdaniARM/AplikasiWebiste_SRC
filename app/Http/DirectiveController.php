<?php

namespace App\Http\Controllers;

use App\Models\Directive;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DirectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $directives = Directive::query();
        if ($request->ajax()) {
            return DataTables::eloquent($directives)
                ->addIndexColumn()
                ->editColumn('created_at', function (Directive $dir) {
                    return $dir->created_at->format('d-m-Y');
                })
                ->editColumn('link', function (Directive $dir) {
                    return '<a href="'.$dir->link.'" target="_blank">See...</a>';
                })
                ->addColumn('action', 'dashboard.directive.action')
                ->rawColumns(['action', 'link'])
                ->toJson();
        }

        $title = 'Delete Directive !!';
        $text = 'Are you sure you want to delete ??';
        confirmDelete($title, $text);

        return view('dashboard.directive.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5'],
            'link' => ['required', 'string', 'min:5'],
        ]);

        try {
            Directive::create([
                'name' => $request->name,
                'slug' => SlugService::createSlug(Directive::class, 'slug', $request->name),
                'link' => $request->link,
            ]);

            alert()->success('Success', 'Success to create directive');

            return redirect()->route('directive.index');
        } catch (\Throwable $th) {
            alert()->error('Error', 'Failed to create directive');

            return redirect()->route('directive.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dir = Directive::findOrFail($id);

        return response()->json($dir);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nameEdit' => ['required', 'string', 'min:5'],
            'linkEdit' => ['required', 'string', 'min:5'],
        ]);

        $dir = Directive::findOrFail($id);

        try {
            $dir->update([
                'name' => $request->nameEdit,
                'slug' => SlugService::createSlug(Directive::class, 'slug', $request->nameEdit),
                'link' => $request->linkEdit,
            ]);

            alert()->success('Success', 'Success to update directive');

            return redirect()->route('directive.index');
        } catch (\Throwable $th) {
            alert()->error('Error', 'Failed to update directive');

            return redirect()->route('directive.index');
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
        $dir = Directive::findOrFail($id);

        try {
            $dir->delete();

            alert()->success('Success', 'Success to delete directive');

            return redirect()->route('directive.index');
        } catch (\Throwable $th) {
            alert()->error('Error', 'Failed to delete directive');

            return redirect()->route('directive.index');
        }
    }
}
