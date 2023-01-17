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

<form action="{{ route('books.update', $book[0]->id) }}" method="POST">
    @csrf
    @method('PUT')
     <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Book Name:</strong>
                <input type="text" name="name" class="form-control" value="{{$book[0]->name}}" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Book Year:</strong>
                <input class="form-control"  name="year" value="{{$book[0]->year}}" placeholder="Year"></input>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Author Name:</strong>
                <select name="author" class="custom-select mb-3" >
                    <option value="" >Select Author Name</option>
                    @foreach ($authors as $author)
                        @if($book[0]->author->id == $author->id) {
                            <option value="{{$author->id}}" selected>{{$author->name}}</option>
                        } @else {
                            <option value="{{$author->id}}" >{{$author->name}}</option>
                        }
                        @endif
                    @endforeach
                </select>

            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <strong>Library Name:</strong>
            <select name="library" class="custom-select mb-3">
                <option value="" selected>Select Library Name</option>
                @foreach ($libraries as $library)
                    @if(isset($book[0]->library[0]->id) == $library->id) {
                        <option value="{{$library->id}}" selected>{{$library->name}}</option>
                    } @else {
                        <option value="{{$library->id}}" >{{$library->name}}</option>
                    }
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>
@endsection
