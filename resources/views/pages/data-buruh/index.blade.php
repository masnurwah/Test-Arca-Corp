@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            
            <a href="{{ route('data-buruh.create') }}" class="btn btn-success mb-3">Add</a>
            @if (Session::has('success-message'))
            <div class="alert alert-success">
                {{ Session::get('success-message') }}
            </div>
            @endif

            <div class="card">

                <div class="card-header">Data Buruh</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($models as $key => $model)
                            <tr>
                                <td>{{ $model->name }}</td>
                                <td>   
                                    <a class="btn btn-primary" href="{{ route('data-buruh.edit', $model->id) }}">Edit</a>
                                    <a class="btn btn-danger ml-2" href="{{ route('data-buruh.destroy', $model->id) }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">Delete</a>

                                    <form action="{{ route('data-buruh.destroy', $model->id) }}" id="delete-form"
                                        method="post">
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