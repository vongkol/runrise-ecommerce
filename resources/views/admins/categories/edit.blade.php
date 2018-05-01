@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Edit Category&nbsp;&nbsp;
            <a href="{{url('admin/category')}}">Back</a>
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

            <form action="{{ url('/admin/category/update/' . $category->id . '/' . $pgnum) }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}" required autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="parent_id" class="col-sm-2 col-form-label">Parent Name <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control" id="parent_id" name="parent_id">
                        <option value="0" {{$category->parent_id == 0 ? 'Selected' : ''}}>Choose ...</option>
                        @foreach ($categories as $categ)
                            <option value="{{$categ->id}}" {{$category->parent_id == $categ->id ? 'Selected' : ''}}>{{$categ->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="icon" class="col-sm-2 col-form-label">Icon</label>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="form-control custom-file-input" id="icon" name="icon" onchange="loadFile(e)">
                            <label class="custom-file-label" for="icon" id="display_icon">{{$category->icon}}</label>
                        </div>
                        <img src="{{asset('uploads/categories/' . $category->icon)}}" alt="" id="preview" width="170">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit">Save</button>
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
        $('#display_icon').html(this.files[0].name)
    }
</script>
@endsection