<?php

namespace App\Http\Controllers;

use App\Http\Requests\RaceRequest;
use App\Models\Category;
use App\Models\Race;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Race::with(['category']);

            return DataTables::eloquent($categories)
                ->addIndexColumn()
                ->editColumn('price', function (Race $race) {
                    return 'Rp. '.number_format($race->price, 0, ',', '.');
                })
                ->editColumn('image', function (Race $race) {
                    return '<a href="'.asset($race->image).'" target="_blank">See Image</a>';
                })
                ->editColumn('team', function (Race $race) {
                    return $race->team == 1 ? 'true' : 'false';
                })
                ->addColumn('action', 'dashboard.race.action')
                ->rawColumns(['image', 'action'])
                ->toJson();
        }

        $title = 'Delete race!';
        $text = 'Are you sure, you want to delete ??';
        confirmDelete($title, $text);

        return view('dashboard.race.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('dashboard.race.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RaceRequest $request)
    {
        try {
            if (! File::isDirectory('images/race')) {
                File::makeDirectory('images/race', 0777, true, true);
            }

            $path = 'images/race/race.jpg';
            if (! is_null($request->path)) {
                $path = 'images/race/'.trim($request->path, '"');
                $old = public_path().'/tmp/uploads/'.trim($request->path, '"');
                $new = public_path().'/'.$path;
                File::move($old, $new);
            }

            $max = is_null($request->max_people) ? 1 : $request->max_people;

            Race::create([
                'category_id' => $request->category,
                'name' => $request->name,
                'slug' => SlugService::createSlug(Race::class, 'slug', $request->name),
                'description' => $request->description,
                'point' => $request->point,
                'duration' => $request->duration,
                'session' => $request->session,
                'date_race' => $request->date_race,
                'price' => $request->price,
                'deadline_reg' => $request->deadline_reg,
                'team' => $request->boolean('team'),
                'max_people' => $max,
                'document' => $request->boolean('document'),
                'image' => $path,
            ]);

            alert()->success('Success', 'Create race is success');

            return redirect()->route('race.index');
        } catch (\Throwable $th) {
            alert()->error('Error', 'Create race is failed');

            return redirect()->route('race.index');
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
        $race = Race::with('category')->findOrFail($id);

        return view('dashboard.race.show', compact('race'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $race = Race::with('category')->findOrFail($id);

        return view('dashboard.race.edit', compact('race', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RaceRequest $request, $id)
    {
        $race = Race::findOrfail($id);

        try {
            if (! File::isDirectory('images/race')) {
                File::makeDirectory('images/race', 0777, true, true);
            }

            $path = $race->image;
            if (! is_null($request->path)) {
                $path = 'images/race/'.trim($request->path, '"');
                $old = public_path().'/tmp/uploads/'.trim($request->path, '"');
                $new = public_path().'/'.$path;
                File::move($old, $new);
                File::delete(public_path().'/'.$race->image);
            }

            $max_people = $race->max_people;
            if ($request->boolean('team') == false) {
                $max_people = 1;
            } else {
                $max_people = $request->max_people;
            }

            $race->update([
                'category_id' => $request->category,
                'name' => $request->name,
                'slug' => SlugService::createSlug(Race::class, 'slug', $request->name),
                'description' => $request->description,
                'point' => $request->point,
                'duration' => $request->duration,
                'session' => $request->session,
                'date_race' => $request->date_race,
                'price' => $request->price,
                'deadline_reg' => $request->deadline_reg,
                'team' => $request->boolean('team'),
                'max_people' => $max_people,
                'document' => $request->boolean('document'),
                'image' => $path,
            ]);

            alert()->success('Success', 'Update race is success');

            return redirect()->route('race.index');
        } catch (\Throwable $th) {
            alert()->error('Error', 'Update race is failed');

            return redirect()->route('race.index');
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
        $race = Race::findOrFail($id);

        try {
            $race->delete();
            File::delete(public_path().'/'.$race->image);

            alert()->success('Success', 'Delete race is success');

            return redirect()->route('race.index');
        } catch (\Throwable $th) {
            alert()->error('Error', 'Delete race is failed');

            return redirect()->route('race.index');
        }
    }
}
