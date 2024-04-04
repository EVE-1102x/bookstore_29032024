@extends('layouts.master')
@section('title','Employee')
@section('content')
<div class="container-fluid mt-3">
    <div class="card mt-4">
        <div class="card-header">
            <h4>
                <a href="{{ url('admin/add-employees') }}" class="btn btn-primary float-end">Add Employee</a>
                View Employees
            </h4>
        </div>

        <div class="card-body">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="table-responsive-md">
                <table class="table table-hover table-striped text-center">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th colspan="2">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($employee as $Employee)
                        <tr>
                            <td>{{ $Employee->id }}</td>
                            @foreach($user as $User)
                                @if($Employee->UserID == $User->id)
                                    <td>{{ $User->email }}</td>
                                @endif
                            @endforeach

                            @foreach($user as $User)
                                @if($Employee->UserID == $User->id)
                                    <td>{{ $User->name }}</td>
                                @endif
                            @endforeach

                            @foreach($user as $User)
                                @if($Employee->UserID == $User->id)
                                    <td>{{ $User->phone != null? $User->phone:'NULL' }}</td>
                                @endif
                            @endforeach

                            <td>{{ $Employee->ERole == '1'? 'Admin':'Employee' }}</td>

                            <td>
                                <a href="{{ url('admin/edit-employees/'.$Employee->id) }}" class="btn btn-success">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <a href="{{ url('admin/delete-employees/'.$Employee->id) }}" class="btn btn-danger">
                                    <i class="fa fa-thin fa-trash-can fa-md"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

