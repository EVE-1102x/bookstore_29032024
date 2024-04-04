@extends('layouts.master')
@section('title', 'Add Publisher')
@section('content')
    <div class="container-fluid mt-3">
        <div class="card mt-5">
            <div class="card-header">
                <h4>Add Publisher
                    <a href="{{ url('admin/publishers') }}" class="btn btn-primary float-end">Go Back</a>
                </h4>
            </div>

            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $errors)
                            <div>{{$errors}}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('admin/add-publishers') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--Publisher Name-->
                    <div class="mb-3">
                        <label>Publisher Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" required/>
                    </div>

                    <!--Publisher Address-->
                    <div class="mb-3">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Enter Address" required/>
                    </div>

                    <!--Phone Number-->
                    <div class="mb-3">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" required/>
                    </div>

                    <!--Submit Button-->
                    <div>
                        <button type="submit" class="btn btn-primary">Add New</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
