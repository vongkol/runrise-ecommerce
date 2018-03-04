@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Page List&nbsp;&nbsp;
            <a href="{{url('admin/page/create')}}">New</a>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
            
        </div>
    </div>
@endsection