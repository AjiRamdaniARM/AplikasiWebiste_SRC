<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $categories = Category::query();

            return DataTables::eloquent($categories)
                ->addIndexColumn()
                ->editColumn('created_at', function (Category $category) {
                    return $category->created_at->format('d-m-Y');
                })
                ->addColumn('action', 'dashboard.category.action')
                ->toJson();
        }

        $title = 'Delete Category!';
        $text = 'Are you sure you want to delete?';
        confirmDelete($title, $text);

        return view('dashboard.category.index');
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
            'name' => ['required', 'string', 'min:2'],
        ]);

        try {
            Category::create([
                'name' => $request->name,
                'slug' => SlugService::createSlug(Category::class, 'slug', $request->name),
            ]);

            alert()->success('Success', 'Create category');

            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            alert()->error('Oops !!', 'Failed create category');

            return redirect()->route('category.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'nameEdit' => ['required', 'string', 'min:2'],
        ]);

        try {
            $category->update([
                'name' => $request->nameEdit,
                'slug' => SlugService::createSlug(Category::class, 'slug', $request->nameEdit),
            ]);

            alert()->success('Success', 'Update category');

            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            alert()->error('Oops !!', 'Failed update category');

            return redirect()->route('category.index');
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
        $category = Category::findOrFail($id);

        try {
            $category->delete();

            alert()->success('Success', 'Delete category');

            return redirect()->route('category.index');
        } catch (\Throwable $th) {
            alert()->error('Oops !!', 'Failed delete category');

            return redirect()->route('category.index');
        }
    }
}
