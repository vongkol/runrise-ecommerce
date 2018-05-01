@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Category List &nbsp;
            <a href="{{url('/admin/category/create')}}">New</a>
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
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Parent Name</th>
                        <th>Icon</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->parent_name}}</td>
                            <td>{{$category->icon}}</td>
                            <td>
                                <a href="{{url('/admin/category/edit/' . $category->id 
                                . '/' . $categories->currentPage())}}">
                                    <i class="fa fa-edit text-success"></i>
                                </a>
                                <a href="{{url('/admin/category/delete/' . $category->id 
                                . '/' . $categories->currentPage().'/'.$categories->count())}}"
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
                @if($categories->lastPage()>1)
                <ul class="pagination">
                    <li class="page-item {{$categories->currentPage() == 1 ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/category')}}">
                        <i class="fa fa-angle-double-left"></i></a>
                    </li>
                    <li class="page-item {{$categories->currentPage() == 1 ? 'disabled':''}}">
                        <a class="page-link" href="{{$categories->previousPageUrl()}}">
                        <i class="fa fa-angle-left"></i></a>
                    </li>
                    
                    @for ($i = 1; $i <= $categories->lastPage(); $i++)
                    <li class="page-item {{$categories->currentPage() == $i ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/category?page='.$i)}}">{{$i}}</a>
                    </li>
                    @endfor

                    <li class="page-item {{$categories->currentPage() == $categories->lastPage() ? 'disabled':''}}">
                        <a class="page-link" href="{{$categories->nextPageUrl()}}">
                        <i class="fa fa-angle-right"></i></a>
                    </li>
                    <li class="page-item {{$categories->currentPage() == $categories->lastPage() ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/category?page='.$categories->lastPage())}}">
                        <i class="fa fa-angle-double-right"></i></a>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </div>
@endsection