@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Create New Page&nbsp;&nbsp;
            <a href="{{url('admin/page')}}">Back</a>
        </div>
        <div class="card-body">
            <form action="{{url('/admin/page/save')}}" class="form-horizontal" method="POST">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="title" class="control-label col-sm-2">Page Title <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="control-label col-sm-2">Description</label>
                    <div class="col-sm-4">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <textarea name="description" id="description" cols="30" rows="10"></textarea>
                        <br>
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