@extends('layouts.master')
@section('title','Customer')
@section('content')
    <div class="container-fluid mt-3">
        <div class="card mt-4">
            <div class="card-header">
                <h4>
                    <a href="{{ url('admin/discounts') }}" class="btn btn-primary ms-1 float-end">
                        View Discounts
                    </a>
                    View Customers
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
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($customer as $Customer)
                            <tr>
                                <td>{{ $Customer->id }}</td>
                                @foreach($user as $User)
                                    @if($Customer->UserID == $User->id)
                                        <td>{{ $User->email }}</td>
                                    @endif
                                @endforeach

                                @foreach($user as $User)
                                    @if($Customer->UserID == $User->id)
                                        <td>{{ $User->name }}</td>
                                    @endif
                                @endforeach

                                @foreach($user as $User)
                                    @if($Customer->UserID == $User->id)
                                        <td>{{ $User->phone != null? $User->phone:'NULL' }}</td>
                                    @endif
                                @endforeach

                                <td>{{ $Customer->DiscountID }}</td>

                                <td>
                                    <a href="{{ url('admin/edit-customers/'.$Customer->id) }}" class="btn btn-success">
                                        <i class="fa-solid fa-pen"></i>
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

