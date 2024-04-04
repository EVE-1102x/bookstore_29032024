@extends('layouts.master')
@section('title','Orders')
@section('content')
<div class="container-fluid mt-3">
    <div class="card mt-4">
        <div class="card-header">
            <h4>
                <a href="{{ url('admin/paymentmethods') }}" class="btn btn-warning float-end">View Payment Method</a>
                <a href="{{ url('admin/add-orders') }}" class="btn btn-primary float-end me-3">Add Order</a>
                View Orders
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
                    <th>Customer Name</th>
                    <th>Employee Name</th>
                    <th>Total Price</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($orders as $Orders)
                    <tr>
                        <td>{{ $Orders->id }}</td>
                        @foreach($user as $User)
                            @if($Orders->CustomerID == $User->id && $User->role_as == '0')
                                <td>{{ $User->email }}</td>
                            @endif
                        @endforeach

                        @foreach($user as $User)
                            @if($Orders->EmployeeID == $User->id)
                                <td>{{ $User->name }}</td>
                            @endif
                        @endforeach

                        <td>{{ $Orders->totalPrice }}$</td>

                        @foreach($paymentmethods as $PaymentMethods)
                            @if($Orders->PaymentID == $PaymentMethods->id)
                                <td>{{ $PaymentMethods->name }}</td>
                            @endif
                        @endforeach

                        <?php
                        // Check the value of $Order->OrdStatus and assign the appropriate status to $status variable
                        $status = '';
                        switch ($Orders->status) {
                            case '1':
                                $status = 'awaiting confirmation';
                                break;
                            case '2':
                                $status = 'shipping';
                                break;
                        } ?>
                        <td><?php echo $status; ?></td>

                        <td>
                            <a href="{{ url('admin/edit-orders/'.$Orders->id) }}" class="btn btn-success">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <a href="{{ url('admin/delete-orders/'.$Orders->id) }}" class="btn btn-danger">
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
