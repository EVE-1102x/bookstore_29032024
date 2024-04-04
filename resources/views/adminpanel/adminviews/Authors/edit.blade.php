@extends('layouts.master')
@section('title', 'Edit Authors')
@section('content')
    <div class="container-fluid mt-3">
        <div class="card m-4">
            <div class="card-header">
                <h4 class="fw-bold fs-3">Edit Author
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

                <form action="{{ url('admin/edit-authors/'.$authors->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Author Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $authors->name }}"/>
                    </div>

                    <div class="mb-3">
                        <label>address</label>
                        <input type="text" name="address" class="form-control" value="{{ $authors->address }}"/>
                    </div>

                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ $authors->phone }}"/>
                    </div>

                    <div class="mb-3">
                        <label>Date Of Birth</label>
                        <input type="date" name="DOB" class="form-control" value="{{ $authors->DOB }}"/>
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Save Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
