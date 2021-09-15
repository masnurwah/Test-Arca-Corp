@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <a href="{{ route('data-bonus.create') }}" class="btn btn-success mb-3">Add</a>

            @if (Session::has('success-message'))
            <div class="alert alert-success mb-3">
                {{ Session::get('success-message') }}
            </div>
            @endif


            <div class="card">

                <div class="card-header">Data User</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID Pembayaran</th>
                                <th scope="col">Jumlah Pembayaran</th>
                                <th scope="col">Jumlah Buruh</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($models as $key => $model)
                            <tr>
                                <td>{{ $model->id_pembayaran }}</td>
                                <td>{{ $model->total_bonus }}</td>
                                <td>{{ $model->jumlah_buruh }}</td>
                                <td>

                                    <a class="btn btn-warning"
                                        href="{{ route('data-bonus.show', $model->id_pembayaran) }}">View Detail</a>

                                    <a class="btn btn-primary"
                                        href="{{ route('data-bonus.edit', $model->id_pembayaran) }}">Edit</a>


                                    <a class="btn btn-danger ml-2"
                                        href="{{ route('data-bonus.destroy', $model->id_pembayaran) }}" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">Delete</a>

                                    <form action="{{ route('data-bonus.destroy', $model->id_pembayaran) }}"
                                        id="delete-form" method="post">
                                        @method('delete')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection