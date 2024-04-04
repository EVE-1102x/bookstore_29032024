@extends('layouts.master')
@section('title','Create Order')
@section('content')
<div class="container-fluid px-4">
<div class="card mt-4">
<div class="card-header">
    <h4>
        <a href="{{ url('admin/orders') }}" class="btn btn-primary float-end">Go Back</a>
        Add New Order
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

<form action="{{ url('admin/add-orders') }}" method="POST" enctype="multipart/form-data">
    @csrf

<!--Customer name-->
<div class="mb-3">
    <label>Customer name</label>
    <select name="CustomerID" class="form-select">
        @foreach($customers as $Customers)
        @endforeach

        @foreach($users as $Users)
            @if($Users->role_as == '0')
                <option value="{{ $Customers->id }}">{{ $Users->name }}</option>
            @endif
        @endforeach
    </select>
</div>

<!--Ship Address-->
<div class="mb-3">
    <label>Address</label>
    <input type="text" name="address" class="form-control" placeholder="Enter ship address"
           required/>
</div>

<!--Payment Method-->
<div class="mb-3">
    <label>Payment Method</label>
    <select name="PaymentID" class="form-select">
        @foreach($paymentMethod as $PaymentMethod)
            <option value="{{ $PaymentMethod->id }}">{{ $PaymentMethod->name }}</option>
        @endforeach
    </select>
</div>

<!--Order Status-->
<div class="mb-3">
    <label>Order Status</label>
    <select name="status" class="form-select">
        <option value="1">awaiting confirmation</option>
        <option value="2">shipping</option>
    </select>
</div>

<!--Products Menu Table-->
<div class="mb-3">
<label>Book Chose</label>
<a href="{{ url('admin/create-bookMenu') }}" class="btn btn-primary ms-2">Add Books</a>

<table class="table table-light table-striped table-hover text-center">
<thead>
<tr>
    <th>Name</th>
    <th>Image</th>
    <th>Category</th>
    <th>Price</th>
    <th>Sold Out</th>
    <th>Sub total</th>
    <th>Total Cost</th>
</tr>
</thead>

<tbody>
@if($product_chose == null)
<tr>
<td colspan="7">
<img src="{{ asset('uploads/backgroundImages/emptyTableProduct.png') }}"
     class="img-fluid" alt="ERROR!" height="700px">
</td>
</tr>
@else

@foreach($orderdetails as $OrderDetails)
@foreach($product as $Product)
@if($OrderDetails->ProductID == $Product->id && $OrderDetails->OrderID == $order_id)
<tr>
    <td>{{ $Product->ProName }}</td>
    <td><img src="{{ asset('uploads/piece/'.$Product->ProImage) }}"
             style="height: 108px" width="192px" alt="Img"></td>
    <td>{{ $Product->ProPrice }}$</td>
    <td>{{ $OrderDetails->SubTotal }}$</td>

    @foreach($category as $Category)
        @if($Product->CategoryID == $Category->id)
            <td>{{ $Category->CName }}</td>
        @endif
    @endforeach

    <td>{{ $OrderDetails->SoldOut }}</td>
    <td>{{ $order->TotalPrice }}$</td>
</tr>
@endif
@endforeach
@endforeach
@endif
</tbody>
</table>
</div>

<div class="mb-3">
    <button type="submit" class="btn btn-success">Add New</button>
</div>
</form>
</div>
</div>
</div>
@endsection
