
@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Create New Shop &nbsp;
            <a href="{{url('/admin/shop')}}">Back</a>
        </div>
        <div class="card-body">
            @if(Session::has('smsf') || Session::has('smss'))
            <div class="alert {{ Session::has('smsf') ? 'alert-danger' : 'alert-success' }}
             alert-dismissible fade show autoCls" role="alert">
                <strong>{{ Session::has('smsf') ? 'Failed' : 'Successful' }}!</strong>
                 {{Session::has('smsf') ? session('smsf') : session('smss')}}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <form action="{{url('/admin/shop/save')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group row">
                    <label for="name" class="control-label col-sm-2">Name</label>
                    <div class="col-sm-8">
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="control-label col-sm-2">Address</label>
                    <div class="col-sm-8">
                        <input type="text" id="address" name="address" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="control-label col-sm-2">Phone</label>
                    <div class="col-sm-8">
                        <input type="text" id="phone" name="phone" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="control-label col-sm-2">Email</label>
                    <div class="col-sm-8">
                        <input type="text" id="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="logo" class="control-label col-sm-2">Logo</label>
                    <div class="col-sm-8">
                        <input type="file" id="logo" name="logo" class="form-control" onchange="loadFile(event)">
                        <br/>
                        <img src="" alt="" id="preview" width="170">
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="control-label col-sm-2">&nbsp;</label>
                    <div class="col-sm-8">
                        <button class="btn btn-primary" type="sumbit">Save</button>
                        <button class="btn btn-danger" type="Reset">Cancel</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('js')
<script>
    function loadFile(e){
        var output = document.getElementById('preview');
        output.src = URL.createObjectURL(e.target.files[0]);
    }
</script>
@endsection