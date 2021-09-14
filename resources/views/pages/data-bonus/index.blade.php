@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            @if (Session::has('success-message'))
            <div class="alert alert-success">
                {{ Session::get('success-message') }}
            </div>
            @endif

            <a href="{{ route('data-user.create') }}" class="btn btn-success mb-3">Add</a>
            <div class="card">

                <div class="card-header">Data User</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($models as $key => $model)
                            <tr>
                                <td>{{ $model->name }}</td>
                                <td>{{ $model->email }}</td>
                                <td>{{ $model->role }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('data-user.edit', $model) }}">Edit</a>
                                    <a class="btn btn-danger ml-2"
                                        href="{{ route('data-user.destroy', $model) }}">Delete</a>
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