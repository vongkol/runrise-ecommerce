@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            role List
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

            
            @if (Session::has('rlid'))
                <form class="form-horizontal" method="post" action="{{url('/admin/role/update/' . session('rlid') . '/' . $roles->currentPage())}}">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="name" class="col-sm-1 col-form-label">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="name" name="name" value="{{ session('rlname') }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Edit</button>
                    </div>
                </form>
            @else
                <form class="form-horizontal" method="post" action="{{url('/admin/role/' . $roles->currentPage())}}">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="name" class="col-sm-1 col-form-label">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Add New</button>
                    </div>
                </form>
            @endif

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                <a href="{{url('/admin/role/edit/' . $role->id 
                                . '/' . $roles->currentPage())}}">
                                    <i class="fa fa-edit text-success"></i>
                                </a>
                                <a href="{{url('/admin/role/delete/' . $role->id 
                                . '/' . $roles->currentPage().'/'.$roles->count())}}"
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
                @if($roles->lastPage()>1)
                <ul class="pagination">
                    <li class="page-item {{$roles->currentPage() == 1 ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/role')}}">
                        <i class="fa fa-angle-double-left"></i></a>
                    </li>
                    <li class="page-item {{$roles->currentPage() == 1 ? 'disabled':''}}">
                        <a class="page-link" href="{{$roles->previousPageUrl()}}">
                        <i class="fa fa-angle-left"></i></a>
                    </li>
                    
                    @for ($i = 1; $i <= $roles->lastPage(); $i++)
                    <li class="page-item {{$roles->currentPage() == $i ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/role?page='.$i)}}">{{$i}}</a>
                    </li>
                    @endfor

                    <li class="page-item {{$roles->currentPage() == $roles->lastPage() ? 'disabled':''}}">
                        <a class="page-link" href="{{$roles->nextPageUrl()}}">
                        <i class="fa fa-angle-right"></i></a>
                    </li>
                    <li class="page-item {{$roles->currentPage() == $roles->lastPage() ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/role?page='.$roles->lastPage())}}">
                        <i class="fa fa-angle-double-right"></i></a>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </div>
@endsection