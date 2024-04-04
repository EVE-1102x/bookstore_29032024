@extends('layouts.master')
@section('title', 'Add Authors')
@section('content')
    <div class="container-fluid mt-3">
        <div class="card m-4">
            <div class="card-header">
                <h4 class="fw-bold fs-3">Add Author
                    <a href="{{ url('admin/authors') }}" class="btn btn-primary btn-sm float-end">Go back</a>
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

                <form action="{{ url('admin/add-authors') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Author Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Author name" required/>
                    </div>

                    <div class="mb-3">
                        <label>address</label>
                        <input type="text" name="address" class="form-control" placeholder="Enter Author address" required/>
                    </div>

                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" min="10" max="10"
                               placeholder="Enter Author phone number" required/>
                    </div>

                    <div class="mb-3">
                        <label>Date Of Birth</label>
                        <input type="date" name="DOB" class="form-control" required/>
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Add New</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
