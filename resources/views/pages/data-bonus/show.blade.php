@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <div class="card">
                <div class="card-header">View Detail</div>

                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h6 class="p-3 text-center">
                                Hasil Generate dengan ID {{ $models['id_pembayaran'] }}
                            </h6>
                        </div>
                        <div class="col-md-12">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="3">Jumlah Pembayaran : {{ $models['jumlah_pembayaran'] }}</th>
                                    </tr>
                                    <tr>
                                        <th>Nama Buruh</th>
                                        <th>Presentase Bonus</th>
                                        <th>Total Bonus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($models['data'] as $key => $data)
                                    <tr>
                                        <td> {{ $data['data_buruh']['name'] }}</td>
                                        <td> {{ $data['presentase_bonus'] }} %</td>
                                        <td> Rp. {{ $data['total_bonus'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="row ">
                        <div class="col text-center">

                            <a href="{{ route('data-bonus.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection