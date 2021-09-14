@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">



            <a href="{{ route('data-user.create') }}" class="btn btn-success mb-3">Add</a>

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
                                    <a class="btn btn-primary" href="{{ route('data-user.edit', $model->id) }}">Edit</a>
                                    @if($model->id != 1)
                                    <a class="btn btn-danger ml-2" href="{{ route('data-user.destroy', $model->id) }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">Delete</a>

                                    <form action="{{ route('data-user.destroy', $model->id) }}" id="delete-form"
                                        method="post">
                                        @method('delete')
                                        @csrf
                                    </form>
                                    @endif
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