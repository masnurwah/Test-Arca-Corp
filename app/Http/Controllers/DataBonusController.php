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
        $id_pembayaran = 'P' . rand(0, 100);

        foreach ($request->pembayaran as $key => $value) {
            DB::table('pembayaran')->insert([
                'id_pembayaran' => $id_pembayaran,
                'jumlah_pembayaran' => $request->jumlah_pembayaran,
                'id_buruh' => $value['id_buruh'],
                'presentase_bonus' => $value['presentase_bonus'],
                'total_bonus' => $value['total_bonus'],
            ]);
        }

        return redirect()
            ->route('data-bonus.index')
            ->with(['success-message' => 'Successfully save data.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request)
    {
        $jumlah_pembayaran = $request->jumlah_pembayaran;

        $presentase_bonus = 0;

        $data_buruh = [];

        foreach ($request->presentase_bonus as $key => $value) {
            $presentase_bonus += $value;

            $buruh = Buruh::where(['id' => $request->id_buruh[$key]])->first();

            $data_buruh[$key]['id_buruh'] = $buruh->id;
            $data_buruh[$key]['nama_buruh'] = $buruh->name;
            $data_buruh[$key]['presentase_bonus'] = $value;
            $data_buruh[$key]['total_bonus'] =
                ($value / 100) * $jumlah_pembayaran;
        }

        if ($presentase_bonus != 100) {
            return response()->json([
                'success' => false,
                'message' => 'Pembagian bonus masih salah',
            ]);
        }

        $view = view('pages.data-bonus.hasil-generate', [
            'jumlah_pembayaran' => $jumlah_pembayaran,
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
        $models_bonus = Bonus::where(['id_pembayaran' => $id])->get();

        $array = [];

        foreach ($models_bonus as $key => $value) {

            $array['jumlah_pembayaran'] = $value['jumlah_pembayaran'];
            $array['id_pembayaran'] = $value['id_pembayaran'];

            $data_buruh = Buruh::where(['id' => $value->id_buruh])->first();

            $array['data'][$key] = $value;
            $array['data'][$key]['data_buruh'] = $data_buruh;
        }

        // dd($array);

        return view('pages.data-bonus.show', [
            'models' => $array,
        ]);
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
