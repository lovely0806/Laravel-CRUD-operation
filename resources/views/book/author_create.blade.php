@extends('book.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mt-5">
        <div class="pull-left">
            <h2>Add Author</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('books.create') }}"> Back</a>
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

<form action="{{ route('authors.store') }}" method="POST">
    @csrf

     <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Birthday:</strong>
                <input class="form-control" type='date' name="birthday" placeholder="Birthday"></input>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Genre:</strong>
                <input class="form-control" name="genre" placeholder="Genre"></input>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>
@endsection
