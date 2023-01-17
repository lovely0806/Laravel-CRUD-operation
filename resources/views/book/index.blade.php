@extends('book.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb" style='margin-top: 55px'>
        <div class='d-flex justify-content-between mb-5'>
            <div class="pull-left" >
                <h2>Book Management System </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('books.create') }}"> Create New Book</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Book Name</th>
            <th>Book Year</th>
            <th>Author Name</th>
            <th>Author Genre</th>
            <th>Library Name</th>
            <th>Library Address</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($books as $book)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $book->name }}</td>
            <td>{{ $book->year }}</td>
            <td>{{ $book->author->name }}</td>
            <td>{{ $book->author->genre }}</td>
            <td>{{ isset($book->library[0]->name) ? $book->library[0]->name : "" }}</td>
            <td>{{ isset($book->library[0]->address) ? $book->library[0]->address : "" }}</td>
            <td>
                <form action="{{ route('books.destroy',$book->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $books->links() !!}

@endsection
