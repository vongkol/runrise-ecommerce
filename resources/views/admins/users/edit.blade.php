@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Edit User&nbsp;&nbsp; 
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

            <form action="{{url('/admin/user/update/' . $user->id . '/' . $pgnum)}}" class="form-horizontal" method="POST">
                {{csrf_field()}}

                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">User Name <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="confirm" class="col-sm-2 col-form-label">Confirm <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="confirm" name="confirm">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="gender" class="col-sm-2 col-form-label">Gender <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender1" value="M"{{$user->gender != 'F' ? ' checked' : ''}}>
                            <label class="form-check-label" for="gender1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender2" value="F"{{$user->gender == 'F' ? ' checked' : ''}}>
                            <label class="form-check-label" for="gender2">Female</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone Number <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="role_id" class="col-sm-2 col-form-label">Role <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <select class="form-control" id="role_id" name="role_id">
                        @foreach ($roles as $role)
                            <option value="{{$role->id}}" {{$user->role_id == $role->id ? 'Selected' : ''}}>{{$role->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-primary btn-danger" type="reset">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

    CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});

</script>
@endsection