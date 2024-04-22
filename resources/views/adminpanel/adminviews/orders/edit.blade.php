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
            <!--message and error-->
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $errors)
                        <div>{{ $errors }}</div>
                    @endforeach
                </div>
            @endif

            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!--Form add book chosen for order-->
            <form action="{{ url('admin/update-order-detail?action=update') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf

            <!--Products Menu Table-->
            <div class="mb-3">
                <table class="table table-light table-striped table-hover text-center">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Price</th>
                        <th>Sold Out</th>
                        <th>Sub total</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if(!isset($_SESSION['OrderDetail']) || $_SESSION['OrderDetail'] == [])
                        <tr>
                            <td colspan="10">
                                <img src="{{ asset('uploads/backgroundImages/emptyTableProduct.png') }}"
                                     class="img-fluid" alt="ERROR!" height="700px">
                            </td>
                        </tr>
                    @else
                        @foreach($_SESSION['OrderDetail'] as $BookID)
                            <tr>
                                <td>{{ $BookID['productID'] }}</td>
                                <td>{{ $BookID['name'] }}</td>
                                <td><img src="{{ asset('uploads/piece/'.$BookID['image']) }}" style="height: 108px" width="192px" alt="Img"></td>

                                @foreach($categories as $Categories)
                                    @if($BookID['CategoryID'] == $Categories->id)
                                        <td>{{ $Categories->name }}</td>
                                    @endif
                                @endforeach

                                @foreach($authors as $Authors)
                                    @if($BookID['AuthorID'] == $Authors->id)
                                        <td>{{ $Authors->name }}</td>
                                    @endif
                                @endforeach

                                @foreach($publishers as $Publishers)
                                    @if($BookID['PublisherID'] == $Publishers->id)
                                        <td>{{ $Publishers->name }}</td>
                                    @endif
                                @endforeach

                                <td>{{ $BookID['price'] }}$</td>

                                <td class="align-content-center">
                                    <input type="number" name="soldOut[]" class="form-control text-center"
                                           value="{{ $BookID['soldOut'] }}"/>
                                </td>

                                <td>{{ $BookID['subTotal'] }}$</td>
                                <td>
                                    <a href="{{ url('admin/update-order-detail?action=delete&id='.$BookID['productID']) }}" class="btn btn-danger">
                                        <i class="fa fa-thin fa-trash-can fa-md"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>

            <div class="row">
                <!--Nav Link menu-->
                <div class="col">
                    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                        <div class="sb-sidenav-menu">

                            <!--Nav link open menu-->
                            <a class="nav-link collapsed d-flex align-items-center pt-2"
                               href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                               aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <div class="sb-sidenav-collapse-arrow">
                                        <i class="fa-solid fa-cart-plus fa-lg"></i>
                                    </div>
                                </div>
                                <span class="fs-5">Add Products</span>
                                <i class="fas fa-angle-down fa-lg"></i>
                            </a>
                        </div>
                    </nav>
                </div>

                <!--Display Total price-->
                <div class="col-auto align-self-center">
                    <p class="text-primary h4 m-0 p-0">
                        Total price:
                        <span class="badge badge-info text-primary">
                            {{ $totalPrice }}$
                        </span>
                    </p>
                </div>

                <!--Button submit all selected products-->
                <div class="col-auto align-self-center">
                    <button type="submit" class="btn btn-primary">Confirm All</button>
                </div>
            </div>

            <div class="collapse mt-3" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <table class="table table-hover table-striped table-dark m-0 p-0">
                    <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Price</th>
                        <th>In Stock</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($books as $book)
                    <tr class="text-center">
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->name }}</td>
                        <td>
                            <img src="{{ asset('uploads/piece/'.$book->image) }}" width="192px" height="108px" alt="Img">
                        </td>

                        <td>
                            @foreach($categories as $category)
                                @if($book->CategoryID == $category->id)
                                    {{ $category->name }}
                                @endif
                            @endforeach
                        </td>

                        <td>
                            @foreach($authors as $author)
                                @if($book->AuthorID == $author->id)
                                    {{ $author->name }}
                                @endif
                            @endforeach
                        </td>

                        <td>
                            @foreach($publishers as $publisher)
                                @if($book->PublisherID == $publisher->id)
                                    {{ $publisher->name }}
                                @endif
                            @endforeach
                        </td>

                        <td>{{ $book->price }}$</td>
                        <td>{{ $book->stock }}</td>
                        <td>
                            <div class="mb-3">
                                <input class="form-check-input mt-0" type="checkbox" name="BookID[]" style="width: 20px; height: 20px"
                                       value="{{ $book->id }}" aria-label="Checkbox for following text input"
                                       @if(isset($_SESSION['OrderDetail'][$book->id]))
                                           checked
                                       @endif/>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </form>

        <!--form add-order-->
        <form action="{{ url('admin/store-orders') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!--Customer name-->
            <div class="mb-3 mt-3">
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

            <div class="d-flex align-items-center justify-content-between">
                <button type="submit" class="btn btn-success">Add New Order</button>
            </div>
        </form>
</div>
</div>
</div>
@endsection
