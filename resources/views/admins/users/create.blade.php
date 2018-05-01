@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Create New User&nbsp;&nbsp;
            <a href="{{url('admin/user')}}">Back</a>
        </div>
        <div class="card-body">
            @if(Session::has('smsf') || Session::has('smss'))
            <div class="alert {{ Session::has('smsf') ? 'alert-danger' : 'alert-success' }} alert-dismissible fade show autoCls" role="alert">
                <strong>{{ Session::has('smsf') ? 'Failed' : 'Successful' }}!</strong>
                 {{Session::has('smsf') ? session('smsf') : session('smss')}}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <form action="{{ url('/admin/user/save') }}" class="form-horizontal" method="POST">
                {{csrf_field()}}

                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">User Name <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}" required autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="confirm" class="col-sm-2 col-form-label">Confirm <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="confirm" name="confirm" value="{{old('confirm')}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="gender" class="col-sm-2 col-form-label">Gender <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender1" value="M"{{old('gender') != 'F' ? ' checked' : ''}}>
                            <label class="form-check-label" for="gender1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender2" value="F"{{old('gender') == 'F' ? ' checked' : ''}}>
                            <label class="form-check-label" for="gender2">Female</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone Number <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="role_id" class="col-sm-2 col-form-label">Role <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <select class="form-control" id="role_id" name="role_id">
                        @foreach ($roles as $role)
                            <option value="{{$role->id}}" {{old('role_id') == $role->id ? 'Selected' : ''}}>{{$role->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
@endsection

@section('js')
@endsection