<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buruh;
use DB;


class DataBuruhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Buruh::get();

        return view('pages.data-buruh.index', [
            'models' => $models,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.data-buruh.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            ]);

        $save = DB::table('buruh')->insert([
            'name' => $request->name,
            ]);

        if ($save) {
            return redirect()
                ->route('data-buruh.index')
                ->with(['success-message' => 'Successfully save data.']);
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
        $model = Buruh::where(['id' => $id])->first();

        // dd($model);

        return view('pages.data-buruh.edit', [
            'model' => $model,
        ]);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Buruh::where(['id' => $id])->first();
        $rules['name'] = 'required';

        $request->validate($rules);

        $model->name = $request->name;
        $update = $model->save();

        if ($update) {
            return redirect()
                ->route('data-buruh.index')
                ->with(['success-message' => 'Successfully update data.']);
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
        $model = Buruh::where(['id' => $id])->first();

        $delete = $model->delete();

        if ($delete) {
            return redirect()
                ->route('data-buruh.index')
                ->with(['success-message' => 'Successfully delete data.']);
        }
    }
}
