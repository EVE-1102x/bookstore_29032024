@extends('layouts.master')
@section('title', 'Add Books')
@section('content')
<div class="container-fluid mt-3">
<div class="card mt-5">
<div class="card-header">
    <h4>Add Book
        <a href="{{ url('admin/Books') }}" class="btn btn-primary float-end">Go Back</a>
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

<form action="{{ url('admin/add-books') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="mb-3">
    <label>Book title</label>
    <input type="text" name="name" class="form-control" placeholder="Enter title" required/>
</div>

<!--Categories option-->
<div class="mb-3">
    <label>Category</label>
    <select name="CategoryID" class="form-control">
        @foreach($categories as $Category)
            <option value="{{ $Category->id }}"> {{ $Category->name }} </option>
        @endforeach
    </select>
</div>

<!--Authors option-->
<div class="mb-3">
    <label>Author</label>
    <select name="AuthorID" class="form-control">
        @foreach($authors as $Authors)
            <option value="{{ $Authors->id }}"> {{ $Authors->name }} </option>
        @endforeach
    </select>
</div>

<!--Publishers option-->
<div class="mb-3">
    <label>Publishers</label>
    <select name="PublisherID" class="form-control">
        @foreach($publishers as $Publishers)
            <option value="{{ $Publishers->id }}"> {{ $Publishers->name }} </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Book Price</label>
    <input type="number" name="price" class="form-control" placeholder="Enter price" min="1" required/>
</div>

<!--Stock option-->
<div class="mb-3">
    <label>InStock</label>
    <input type="number" name="stock" class="form-control" min="1" placeholder="Enter Stock" required/>
</div>

<!--Image option-->
<div class="mb-3">
    <label>Book Image</label>
    <input type="file" name="image" class="form-control" required/>
</div>

<!--Books Description-->
<div class="mb-3">
    <label>Book Description</label>
    <textarea name="description" rows="5" class="form-control" placeholder="Enter Description"></textarea>
</div>

<!--Submit Button-->
<div>
    <button type="submit" class="btn btn-primary float-end">Add new</button>
</div>
</form>
</div>
</div>
</div>
@endsection
