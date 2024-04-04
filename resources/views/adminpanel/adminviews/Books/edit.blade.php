@extends('layouts.master')
@section('title', 'Edit Books')
@section('content')
    <div class="container-fluid mt-3">
        <div class="card mt-5">
            <div class="card-header">
                <h4>Edit Book
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

                <form action="{{ url('admin/update-books/'.$book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!--Book title-->
                    <div class="mb-3">
                        <label>Book title</label>
                        <input type="text" name="name" class="form-control" value="{{ $book->name }}"/>
                    </div>

                    <!--Categories option-->
                    <div class="mb-3">
                        <label>Category</label>
                        <select name="CategoryID" class="form-control">
                            <!--Loop 1 chon ra Category dang dc su dung-->
                            @foreach($categories as $Categories)
                                @if($book->CategoryID == $Categories->id)
                                    <option value="{{ $Categories->id }}"> {{ $Categories->name }} </option>
                                @endif
                            @endforeach

                            <!--Loop 2 chon ra cac Category con lai-->
                            @foreach($categories as $Categories)
                                @if($book->CategoryID != $Categories->id)
                                    <option value="{{ $Categories->id }}"> {{ $Categories->name }} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!--Authors option-->
                    <div class="mb-3">
                        <label>Author</label>
                        <select name="AuthorID" class="form-control">
                            <!--Loop 1 chon ra Author dang dc su dung-->
                            @foreach($authors as $Authors)
                                @if($book->AuthorID == $Authors->id)
                                    <option value="{{ $Authors->id }}"> {{ $Authors->name }} </option>
                                @endif
                            @endforeach

                            <!--Loop 2 chon ra cac Author con lai-->
                            @foreach($authors as $Authors)
                                @if($book->AuthorID != $Authors->id)
                                    <option value="{{ $Authors->id }}"> {{ $Authors->name }} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!--Publishers option-->
                    <div class="mb-3">
                        <label>Publishers</label>
                        <select name="PublisherID" class="form-control">
                            <!--Loop 1 chon ra Publisher dang dc su dung-->
                            @foreach($publishers as $Publishers)
                                @if($book->PublisherID == $Publishers->id)
                                    <option value="{{ $Publishers->id }}"> {{ $Publishers->name }} </option>
                                @endif
                            @endforeach

                            <!--Loop 2 chon ra cac Publisher con lai-->
                            @foreach($publishers as $Publishers)
                                @if($book->PublisherID != $Publishers->id)
                                    <option value="{{ $Publishers->id }}"> {{ $Publishers->name }} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!--Book Price-->
                    <div class="mb-3">
                        <label>Book Price</label>
                        <div class="input-group">
                            <input type="number" name="price" class="form-control" value="{{ $book->price }}"/>
                            <span class="input-group-text">$</span>
                        </div>
                    </div>

                    <!--Stock option-->
                    <div class="mb-3">
                        <label>InStock</label>
                        <div class="input-group">
                            <input type="number" name="stock" class="form-control" min="1" value="{{ $book->stock }}"/>
                            <span class="input-group-text">Copies</span>
                        </div>
                    </div>

                    <!--Image option-->
                    <div class="mb-3">
                        <label>Book Image</label>
                        <input type="file" name="image" class="form-control" value="{{ $book->image }}"/>
                    </div>

                    <!--Books Description-->
                    <div class="mb-3">
                        <label>Book Description</label>
                        <textarea name="description" rows="5" class="form-control">{{ $book->description }}</textarea>
                    </div>

                    <!--Submit Button-->
                    <div>
                        <button type="submit" class="btn btn-primary">Save Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
