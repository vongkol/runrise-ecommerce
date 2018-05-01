@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Create New Page&nbsp;&nbsp;
            <a href="{{url('admin/page')}}">Back</a>
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

            <form action="{{url('/admin/page/save')}}" class="form-horizontal" method="POST">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Page Title <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-12">
                        <textarea name="description" id="description" value="{{old('description')}}" cols="30" rows="10"></textarea>
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
<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

    CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});

</script>
@endsection