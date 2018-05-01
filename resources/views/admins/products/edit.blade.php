
@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            edit Product &nbsp;
            <a href="{{url('/admin/product')}}">Back</a>
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

            <form action="{{url('/admin/product/update/' . $product->id . '/' . $pgnum)}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group row">
                    <label for="name" class="control-label col-sm-2">Name</label>
                    <div class="col-sm-8">
                        <input type="text" id="name" name="name" value="{{$product->name}}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="control-label col-sm-2">Price</label>
                    <div class="col-sm-8">
                        <input type="number" id="price" name="price" value="{{$product->price}}" class="form-control" step="0.1" min="0">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="model" class="control-label col-sm-2">Model</label>
                    <div class="col-sm-8">
                        <input type="text" id="model" name="model" value="{{$product->model}}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="shop_id" class="control-label col-sm-2">Shop Name</label>
                    <div class="col-sm-8">
                        <select id="shop_id" name="shop_id" class="form-control">
                        @foreach ($shops as $shop)
                            <option value="{{$shop->id}}" {{$shop->id == $product->shop_id ? 'selected':''}}>{{$shop->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="discount" class="control-label col-sm-2">Discount</label>
                    <div class="col-sm-8">
                        <input type="number" id="discount" name="discount" value="{{$product->discount}}" class="form-control" step="0.1" min="0">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="front_photo" class="control-label col-sm-2">Front Photo</label>
                    <div class="col-sm-8">
                        <input type="file" id="front_photo" name="front_photo" class="form-control" accept="image/*" onchange="loadFile(event)">
                        <img src="{{url('uploads/products/' . $product->front_photo)}}" alt="" id="preview" width="170">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category_id" class="control-label col-sm-2">Category Name</label>
                    <div class="col-sm-8">
                        <select id="category_id" name="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected':''}}>{{$category->name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="short_description" class="control-label col-sm-2">Short Description</label>
                    <div class="col-sm-8">
                        <textarea name="short_description" id="short_description" cols="30" rows="5" class="form-control">{{$product->short_description}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="control-label col-sm-2">Description</label>
                    <div class="col-sm-8">
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$product->description}}</textarea>
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
<script type="text/javascript">
    function loadFile(e){
        var output = document.getElementById('preview');
        output.src = URL.createObjectURL(e.target.files[0]);
    }
</script>

<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

    CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});

</script>
@endsection