@extends('layouts.master')
@section('title', 'Categories')
@section('content')
    <div class="container-fluid mt-3">
        <div class="card m-4">
            <div class="card-header">
                <h4 class="fw-bold fs-3">Add Categories
                    <a href="{{ url('admin/categories') }}" class="btn btn-primary float-end">Go back</a>
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

                <form action="{{ url('admin/add-categories') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Category Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Category name" required/>
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" rows="5" class="form-control"
                                  placeholder="Enter Description" required></textarea>
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
