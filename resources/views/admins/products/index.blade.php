@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Products List&nbsp;&nbsp;
            <a href="{{url('admin/product/create')}}">New</a>
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

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Shop Name</th>
                        <th>Category Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->shop_name }}</td>
                            <td>{{ $product->category_name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <a href="{{url('/admin/product/edit/' . $product->id . '/' . $products->currentPage())}}">
                                    <i class="fa fa-edit text-success"></i>
                                </a>
                                <a href="{{url('/admin/product/delete/' . $product->id . '/' . $products->currentPage().'/'.$products->count())}}"
                                onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-times-circle text-danger"></i>
                                </a>
                                <a href="{{url('/admin/product/photo/' . $product->id . '/' . $products->currentPage())}}" class="quick-btn">
                                    <i class="fa fa-image"></i>
                                    <span class="badge badge-pill badge-info text-white">{{$product->num_photo}}</span>
                                </a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>

            {{--  pagination  --}}
            <div class="col-12">
                @if($products->lastPage()>1)
                <ul class="pagination">
                    <li class="page-item {{$products->currentPage() == 1 ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/product')}}"><i class="fa fa-angle-double-left"></i></a>
                    </li>
                    <li class="page-item {{$products->currentPage() == 1 ? 'disabled':''}}">
                        <a class="page-link" href="{{$products->previousPageUrl()}}"><i class="fa fa-angle-left"></i></a>
                    </li>
                    
                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                    <li class="page-item {{$products->currentPage() == $i ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/product?page='.$i)}}">{{$i}}</a>
                    </li>
                    @endfor

                    <li class="page-item {{$products->currentPage() == $products->lastPage() ? 'disabled':''}}">
                        <a class="page-link" href="{{$products->nextPageUrl()}}"><i class="fa fa-angle-right"></i></a>
                    </li>
                    <li class="page-item {{$products->currentPage() == $products->lastPage() ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/product?page='.$products->lastPage())}}"><i class="fa fa-angle-double-right"></i></a>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </div>
@endsection