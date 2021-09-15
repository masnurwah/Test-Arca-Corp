<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bonus;
use App\Buruh;
use DB;

class DataBonusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = DB::table('pembayaran')
            ->selectRaw(
                'id_pembayaran, sum(total_bonus) as total_bonus, count(id_buruh) as jumlah_buruh '
            )
            ->groupBy('id_pembayaran')
            ->get();

        return view('pages.data-bonus.index', [
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
        $models_buruh = Buruh::get();

        return view('pages.data-bonus.create', [
            'models_buruh' => $models_buruh,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jumlah_pembayaran = $request->jumlah_pembayaran;

        $presentase_bonus = 0;

        $data_buruh = [];

        foreach ($request->presentase_bonus as $key => $value) {
            $presentase_bonus += $value;

            $buruh = Buruh::where(['id' => $request->id_buruh[$key]])->first();

            $data_buruh[$key]['nama_buruh'] = $buruh->name;
            $data_buruh[$key]['total_bonus'] =
                ($value / 100) * $jumlah_pembayaran;
        }

        if ($presentase_bonus != 100) {
            return response()->json([
                'success' => false,
                'message' => 'Pembagian bonus masih salah',
            ]);
        }

        // return response()->json([
        //     'success' => true,
        //     'data' => $data_buruh,
        // ]);

        $view = view('pages.data-bonus.hasil-generate', [
            'data_buruh' => $data_buruh,
        ])->render();

        return response()->json([
            'success' => true,
            'view' => $view,
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
