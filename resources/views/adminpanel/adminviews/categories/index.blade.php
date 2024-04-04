@extends('layouts.master')
@section('title', 'Categories')
@section('content')
<div class="container-fluid mt-3">
    <div class="card mt-4">
        <div class="card-header">
            <h4>View Categories
                <a href="{{ url('admin/add-categories') }}" class="btn btn-primary float-end">
                    Add Categories
                </a>
            </h4>
        </div>

        <div class="card-body">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="table-responsive-md">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr class="text-center">
                        <td>ID</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Updated at</td>
                        <td colspan="2">Action</td>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($categories as $Categories)
                        <tr class="text-center">
                            <td>{{ $Categories->id }}</td>
                            <td>{{ $Categories->name }}</td>
                            <td>{{ $Categories->description }}</td>
                            <td>{{ $Categories->updated_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ url('admin/edit-categories/'.$Categories->id) }}" class="btn btn-success">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="{{ url('admin/delete-categories/'.$Categories->id) }}" class="btn btn-danger">
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
