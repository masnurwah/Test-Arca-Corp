<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Hash;

class DataUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = User::get();

        return view('pages.data-user.index', [
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
        return view('pages.data-user.create');

        // return redirect()->route('data-user.index')->with(['error-message' => 'Berhasil Menyimpan Data.']);
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
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:8',
        ]);

        $save = DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        if ($save) {
            return redirect()
                ->route('data-user.index')
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
        $model = User::where(['id' => $id])->first();

        // dd($model);

        return view('pages.data-user.edit', [
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
        $model = User::where(['id' => $id])->first();

        $rules['name'] = 'required';
        $rules['role'] = 'required';

        if ($request->email != $model->email) {
            $rules['email'] = 'required|email|unique:users';
        }

        $request->validate($rules);

        $model->name = $request->name;
        $model->email = $request->email;
        $model->role = $request->role;

        $update = $model->save();

        if ($update) {
            return redirect()
                ->route('data-user.index')
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
        $model = User::where(['id' => $id])->first();

        $delete = $model->delete();

        if ($delete) {
            return redirect()
                ->route('data-user.index')
                ->with(['success-message' => 'Successfully delete data.']);
        }
    }
}
