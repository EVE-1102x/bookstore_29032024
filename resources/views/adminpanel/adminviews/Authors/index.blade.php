@extends('layouts.master')
@section('title','Authors')
@section('content')
    <div class="container-fluid mt-3">
        <div class="card mt-4">
            <div class="card-header">
                <h4>
                    <a href="{{ url('admin/add-authors') }}" class="btn btn-primary float-end">Add Authors</a>
                    View Authors
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
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>DOB</th>
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($authors as $Authors)
                            <tr>
                                <td>{{ $Authors->id }}</td>
                                <td>{{ $Authors->name }}</td>
                                <td>{{ $Authors->address }}</td>
                                <td>{{ $Authors->phone }}</td>
                                <td>{{ $Authors->DOB }}</td>

                                <td>
                                    <a href="{{ url('admin/edit-authors/'.$Authors->id) }}" class="btn btn-success">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <a href="{{ url('admin/delete-authors/'.$Authors->id) }}" class="btn btn-danger">
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

