<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Faq::query();
        if ($request->ajax()) {
            return DataTables::eloquent($categories)
                ->addIndexColumn()
                ->editColumn('created_at', function (Faq $faq) {
                    return $faq->created_at->format('d-m-Y');
                })
                ->addColumn('action', 'dashboard.faq.action')
                ->rawColumns(['action', 'answare'])
                ->toJson();
        }

        $title = 'Delete Faq !!';
        $text = 'Are you sure you want to delete ??';
        confirmDelete($title, $text);

        return view('dashboard.faq.index');
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
            'question' => ['required', 'string', 'min:5'],
            'answare' => ['required', 'string', 'min:5'],
        ]);

        try {
            Faq::create([
                'question' => $request->question,
                'slug' => SlugService::createSlug(Faq::class, 'slug', $request->question),
                'answare' => $request->answare,
            ]);

            alert()->success('Success', 'Success to create faq');

            return redirect()->route('faq.index');
        } catch (\Throwable $th) {
            alert()->error('Error', 'Failed to create faq');

            return redirect()->route('faq.index');
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
        $faq = Faq::findOrFail($id);

        return response()->json($faq);
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
            'questionEdit' => ['required', 'string', 'min:5'],
            'answareEdit' => ['required', 'string', 'min:5'],
        ]);

        $faq = Faq::findOrFail($id);

        try {
            $faq->update([
                'question' => $request->questionEdit,
                'slug' => SlugService::createSlug(Faq::class, 'slug', $request->questionEdit),
                'answare' => $request->answareEdit,
            ]);

            alert()->success('Success', 'Success to update faq');

            return redirect()->route('faq.index');
        } catch (\Throwable $th) {
            alert()->error('Error', 'Failed to update faq');

            return redirect()->route('faq.index');
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
        $faq = Faq::findOrFail($id);

        try {
            $faq->delete();

            alert()->success('Success', 'Success to delete faq');

            return redirect()->route('faq.index');
        } catch (\Throwable $th) {
            alert()->error('Error', 'Failed to delete faq');

            return redirect()->route('faq.index');
        }
    }
}
