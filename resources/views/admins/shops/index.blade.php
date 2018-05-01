@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Shops List &nbsp;
            <a href="{{url('/admin/shop/create')}}">New</a>
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

            <table class="table table-condensed">
                <thead>
                    <th>N&ordm;</th>
                    <th>Logo</th>
                    <th>Shop Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($shops as $shop)
                    <tr>
                        <td>{{$shop->id}}</td>
                        <td><img src="{{asset('uploads/shops/' . $shop->logo)}}" width="32"></td>
                        <td>{{$shop->name}}</td>
                        <td>{{$shop->address}}</td>
                        <td>{{$shop->phone}}</td>
                        <td>{{$shop->email}}</td>
                        <td>
                            <a href="{{url('/admin/shop/edit/' . $shop->id . '/' . $shops->currentPage())}}">
                                <i class="fa fa-edit text-success"></i>
                            </a>&nbsp;
                            <a href="{{url('/admin/shop/delete/' . $shop->id . '/' . $shops->currentPage().'/'.$shops->count())}}"
                            onclick="return confirm('Are you sure?')">
                                <i class="fa fa-times-circle text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{--  pagination  --}}
            <div class="col-12">
                @if($shops->lastPage()>1)
                <ul class="pagination">
                    <li class="page-item {{$shops->currentPage() == 1 ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/shop')}}">
                        <i class="fa fa-angle-double-left"></i></a>
                    </li>
                    <li class="page-item {{$shops->currentPage() == 1 ? 'disabled':''}}">
                        <a class="page-link" href="{{$shops->previousPageUrl()}}">
                        <i class="fa fa-angle-left"></i></a>
                    </li>
                    
                    @for ($i = 1; $i <= $shops->lastPage(); $i++)
                    <li class="page-item {{$shops->currentPage() == $i ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/shop?page='.$i)}}">{{$i}}</a>
                    </li>
                    @endfor

                    <li class="page-item {{$shops->currentPage() == $shops->lastPage() ? 'disabled':''}}">
                        <a class="page-link" href="{{$shops->nextPageUrl()}}">
                        <i class="fa fa-angle-right"></i></a>
                    </li>
                    <li class="page-item {{$shops->currentPage() == $shops->lastPage() ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/shop?page='.$shops->lastPage())}}">
                        <i class="fa fa-angle-double-right"></i></a>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </div>
@endsection