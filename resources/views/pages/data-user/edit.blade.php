@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Error</strong><br /><br />
                <ul style="list-style-type: circle;list-style-position: inside;">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card">
                <div class="card-header">Add User</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('data-user.update',$model->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ $model->name }}">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ $model->email }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Role</label>

                            <div class="col-md-6">
                                <select name="role" class="form-control">
                                    <option value="">-- Select Role --</option>
                                    <option value="admin" @if($model->role == "admin") selected @endif >Admin</option>
                                    <option value="regular" @if($model->role == "regular") selected @endif>Regular
                                    </option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ route('data-user.index') }}" type="submit" class="btn btn-danger">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection