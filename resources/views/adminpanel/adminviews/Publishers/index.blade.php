@extends('layouts.master')
@section('title', 'View Publishers')
@section('content')
    <div class="container-fluid mt-3">
        <div class="card mt-5">
            <div class="card-header">

                <!--Error message-->
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $errors)
                            <div>{{$errors}}</div>
                        @endforeach
                    </div>
                @endif

                <h4>
                    View Publishers
                    <a href="{{ url('admin/add-publishers') }}" class="btn btn-primary ms-1 float-end">
                        Add Publishers
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
                            <td>Address</td>
                            <td>Phone</td>
                            <td>update at</td>
                            <td colspan="2">Action</td>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($publishers as $Publishers)
                            <tr class="text-center">
                                <td>{{ $Publishers->id }}</td>
                                <td>{{ $Publishers->name }}</td>
                                <td>{{ $Publishers->address }}</td>
                                <td>{{ $Publishers->phone }}</td>
                                <td>{{ $Publishers->updated_at }}</td>
                                <td>

                                    <a href="{{ url('admin/edit-publishers/'.$Publishers->id) }}"
                                       class="btn btn-success">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <a href="{{ url('admin/delete-publishers/'.$Publishers->id) }}"
                                       class="btn btn-danger">
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
