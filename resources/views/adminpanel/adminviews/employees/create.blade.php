@extends('layouts.master')
@section('title','create Employee')
@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>
                    <a href="{{ url('admin/employees') }}" class="btn btn-primary float-end">Go Back</a>
                    Add Employee
                </h4>
            </div>

            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $errors)
                            <div>{{ $errors }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('admin/add-employees') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Employee email" required>
                    </div>

                    <div class="mb-3">
                        <label>User Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Employee Name" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="enter password" required>
                    </div>

                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" id="password-confirm" name="password-confirm" class="form-control" placeholder="re-enter password" required>
                    </div>

                    <div class="mb-3">
                        <label>Phone Number</label>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" required>
                    </div>

                    <div class="mb-3">
                        <label>Role</label>
                        <select name="ERole" id="ERole" class="form-select">
                            <option value="2">Employee</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add New</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
