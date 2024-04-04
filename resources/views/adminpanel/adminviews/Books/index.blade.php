@extends('layouts.master')
@section('title', 'View Books')
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

<h4>View Books
<a href="{{ url('admin/add-books') }}" class="btn btn-primary float-end">
Add Book
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
    <td>Image</td>
    <td>Category</td>
    <td>Author</td>
    <td>Publisher</td>
    <td>Price</td>
    <td>InStock</td>
    <td colspan="2">Action</td>
</tr>
</thead>

<tbody>
@foreach($books as $Books)
<tr class="text-center">
<td>{{ $Books->id }}</td>
<td>{{ $Books->name }}</td>
<td>
    <img src="{{ asset('uploads/piece/'.$Books->image) }}"
         width="192px" height="108px" alt="Img">
</td>

<td>
    @foreach($categories as $Categories)
        @if($Books->CategoryID == $Categories->id)
            {{ $Categories->name }}
        @endif
    @endforeach
</td>
<td>
    @foreach($authors as $Authors)
        @if($Books->AuthorID == $Authors->id)
            {{ $Authors->name }}
        @endif
    @endforeach
</td>
<td>
    @foreach($publishers as $Publishers)
        @if($Books->PublisherID == $Publishers->id)
            {{ $Publishers->name }}
        @endif
    @endforeach
</td>

<td>{{ $Books->price }}$</td>
<td>{{ $Books->stock }}</td>
<td>
    <a href="{{ url('admin/edit-books/'.$Books->id) }}" class="btn btn-success">
        <i class="fa-solid fa-pen"></i>
    </a>

<a href="{{ url('admin/delete-books/'.$Books->id) }}" class="btn btn-danger">
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
