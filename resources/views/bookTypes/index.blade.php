@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Book Categories</h2>
            </div>
            <div class="pull-right">
                @can('bookType-create')
                <a class="btn btn-success" href="{{ route('bookTypes.create') }}"> Create New Category</a>
                @endcan
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
            <th>Book Category ID</th>
            <th>Category Name</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($bookTypes as $bookType)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $bookType->bookTypeID }}</td>
	        <td>{{ $bookType->bookType }}</td>
	        <td>
                <form action="{{ route('bookTypes.destroy',$bookType->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('bookTypes.show',$bookType->id) }}">Show</a>
                    @can('bookType-edit')
                    <a class="btn btn-primary" href="{{ route('bookTypes.edit',$bookType->id) }}">Edit</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('bookType-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>

    {!! $bookTypes->links() !!}
@endsection