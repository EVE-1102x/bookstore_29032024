@extends('layouts.master')
@section('title','Edit Customer')
@section('content')
    <div class="container-fluid px-4">
        <div class="card m-4">
            <div class="card-header">
                <h4>
                    <a href="{{ url('admin/customers') }}" class="btn btn-primary float-end">Go Back</a>
                    Customer Detail
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

                @foreach($user as $User)
                    @if($customer->UserID == $User->id)
                        <div class="mb-3">
                            <label>Full Name</label>
                            <p class="form-control">{{ $User->name }}</p>
                        </div>
                    @endif
                @endforeach

                @foreach($user as $User)
                    @if($customer->UserID == $User->id)
                        <div class="mb-3">
                            <label>Email</label>
                            <p class="form-control">{{ $User->email }}</p>
                        </div>
                    @endif
                @endforeach

                @foreach($user as $User)
                    @if($customer->UserID == $User->id)
                        <div class="mb-3">
                            <label>Phone Number</label>
                            @if($User->phone == null)
                            <p class="form-control">NULL</p>
                            @else
                            <p class="form-control">{{ $User->phone }}</p>
                            @endif
                        </div>
                    @endif
                @endforeach

                @foreach($user as $User)
                    @if($customer->UserID == $User->id)
                        <div class="mb-3">
                            <label>Level</label>
                            <p class="form-control">{{ $customer->DiscountID }}</p>
                        </div>
                    @endif
                @endforeach

                @foreach($user as $User)
                    @if($customer->UserID == $User->id)
                        <div class="mb-3">
                            <label>Created At</label>
                            <p class="form-control">{{ $User->created_at->format('d/m/Y') }}</p>
                        </div>
                    @endif
                @endforeach

                <div class="mb-3">
                    <label>Order History</label>

                </div>
            </div>
        </div>
    </div>
@endsection
