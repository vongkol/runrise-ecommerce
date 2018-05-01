@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Products Photo List&nbsp;&nbsp;
            <a href="{{url('admin/product'. ($cp > 1 ? '?page='.$cp:''))}}">Back</a>
        </div>
        <div class="card-body">
            @if(Session::has('smsf') || Session::has('smss'))
            <div class="alert {{ Session::has('smsf') ? 'alert-danger' : 'alert-success' }} alert-dismissible fade show autoCls" role="alert">
                @if(Session::has('smsf'))
                <strong>Failed!</strong> {{session('smsf')}}
                @else
                <strong>Successful!</strong> {{session('smss')}}
                @endif

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <form action="{{url('admin/product/photo/uploads/')}}" enctype="multipart/form-data" method="post" class="form-horizonal">
            {{csrf_field()}}
            <input type="hidden" name="id" id="id" value="{{$id}}">
            <input type="hidden" name="cp" id="cp" value="{{$cp}}">
                
                <div class="form-group row">
                    <label for="photo" class="col-sm-1 col-form-label">Photo:</label>
                    <div class="col-sm-9">                                                
                        <div class="custom-file">
                            {{--  use name end with [] symbol for multi upload file  --}}
                            <input type="file" accept="image/*" class="form-control custom-file-input" id="photo" name="photo[]" multiple required>
                            <label class="custom-file-label" for="photo">Choose file...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <button class="btn btn-success" type="sumbit">Upload</button>
                    </div>
                </div>
            </form>

            <div class="row">
            @foreach($photos as $photo)
                <div class="card m-2" style="width: 12rem;">
                    <img class="card-img-top" src="{{asset('uploads/products/250x250/'.$photo->file_name)}}">
                    <div class="card-body pt-0 pb-0">
                        <div class="row p-0">
                            <div class="col-sm-2 p-0 m-0 text-center row align-items-center justify-content-center">
                                <a href="{{url('/admin/product/photo/remove/'.$id.'/'.$cp.'/'.$photo->id)}}"
                                onclick="return comfirm('Are you sure?')">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </div>
                            <div class="col-sm-10 p-0">
                                <small class="text-muted">
                                    {{$photo->file_name}}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
@endsection