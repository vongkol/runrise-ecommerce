@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            User List &nbsp;
            <a href="{{url('/admin/user/create')}}">New</a>
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
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->gender == 'M' ? 'Male':'Female'}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->role}}</td>
                            <td>
                                <a href="{{url('/admin/user/edit/' . $user->id 
                                . '/' . $users->currentPage())}}">
                                    <i class="fa fa-edit text-success"></i>
                                </a>
                                <a href="{{url('/admin/user/delete/' . $user->id 
                                . '/' . $users->currentPage().'/'.$users->count())}}"
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
                @if($users->lastPage()>1)
                <ul class="pagination">
                    <li class="page-item {{$users->currentPage() == 1 ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/user')}}">
                        <i class="fa fa-angle-double-left"></i></a>
                    </li>
                    <li class="page-item {{$users->currentPage() == 1 ? 'disabled':''}}">
                        <a class="page-link" href="{{$users->previousPageUrl()}}">
                        <i class="fa fa-angle-left"></i></a>
                    </li>
                    
                    @for ($i = 1; $i <= $users->lastPage(); $i++)
                    <li class="page-item {{$users->currentPage() == $i ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/user?page='.$i)}}">{{$i}}</a>
                    </li>
                    @endfor

                    <li class="page-item {{$users->currentPage() == $users->lastPage() ? 'disabled':''}}">
                        <a class="page-link" href="{{$users->nextPageUrl()}}">
                        <i class="fa fa-angle-right"></i></a>
                    </li>
                    <li class="page-item {{$users->currentPage() == $users->lastPage() ? 'disabled':''}}">
                        <a class="page-link" href="{{url('/admin/user?page='.$users->lastPage())}}">
                        <i class="fa fa-angle-double-right"></i></a>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </div>
@endsection