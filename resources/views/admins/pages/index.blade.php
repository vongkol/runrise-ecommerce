@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Page List&nbsp;&nbsp;
            <a href="{{url('admin/page/create')}}">New</a>
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
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($pages as $page)
                        <tr>
                            <td>{!! $page->id !!}</td>
                            <td>{!! $page->title !!}</td>
                            <td>{!! $page->description !!}</td>
                            <td>
                                <a href="{{url('/admin/page/edit/' . $page->id . '/' . $pages->currentPage())}}">
                                    <i class="fa fa-edit text-success"></i>
                                </a>
                                <a href="{{url('/admin/page/delete/' . $page->id . '/' . $pages->currentPage().'/'.$pages->count())}}"
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
                @if($pages->lastPage()>1)
                <ul class="pagination">
                    <li class="page-item {{$pages->currentPage() == 1 ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/page')}}"><i class="fa fa-angle-double-left"></i></a>
                    </li>
                    <li class="page-item {{$pages->currentPage() == 1 ? 'disabled':''}}">
                        <a class="page-link" href="{{$pages->previousPageUrl()}}"><i class="fa fa-angle-left"></i></a>
                    </li>
                    
                    @for ($i = 1; $i <= $pages->lastPage(); $i++)
                    <li class="page-item {{$pages->currentPage() == $i ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/page?page='.$i)}}">{{$i}}</a>
                    </li>
                    @endfor

                    <li class="page-item {{$pages->currentPage() == $pages->lastPage() ? 'disabled':''}}">
                        <a class="page-link" href="{{$pages->nextPageUrl()}}"><i class="fa fa-angle-right"></i></a>
                    </li>
                    <li class="page-item {{$pages->currentPage() == $pages->lastPage() ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/page?page='.$pages->lastPage())}}"><i class="fa fa-angle-double-right"></i></a>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </div>
@endsection