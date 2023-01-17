@extends('book.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb" style="margin-top: 55px">
        <div class="d-flex justify-content-between">
            <div class="pull-left">
                <h2>Add New Book</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('books.index') }}"> Back</a>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Error!</strong> <br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('books.store') }}" method="POST">
    @csrf

     <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Book Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Book Year:</strong>
                <input class="form-control"  name="year" placeholder="Year"></input>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group">
                <strong>Author Name:</strong>
                <select name="author" class="custom-select mb-3">
                    <option value="" selected>Select Author Name</option>
                    @foreach ($authors as $author)
                    <option value="{{$author->id}}">{{$author->name}}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 mt-4">
            <a class="btn btn-success" href="{{ route('authors.index') }}">Add Author</a>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <strong>Library Name:</strong>
            <select name="library" class="custom-select mb-3">
                <option value="" selected>Select Library Name</option>
                @foreach ($libraries as $library)
                <option value="{{$library->id}}">{{$library->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3 mt-4">
            <a class="btn btn-success" href="{{ route('library.index') }}" >Add Library</a>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>
@endsection
