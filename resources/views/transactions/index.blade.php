@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Transactions</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('transactions.create') }}"> Create New Transaction</a>
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
            <th>Transaction ID</th>
            <th>Book ID</th>
            <th>Quantity</th>
            <th>Return Date</th>
            <th>Fine Days</th>
            <th>Fine</th>
        </tr>
	    @foreach ($transactions as $transaction)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $transaction->transID }}</td>
	        <td>{{ $transaction->bookID }}</td>
	        <td>{{ $transaction->qty }}</td>
	        <td>{{ $transaction->returnDate }}</td>
	        <td>{{ $transaction->fineDays }}</td>
	        <td>{{ $transaction->fine }}</td>
	        <td>
                <form action="{{ route('transactions.destroy',$transaction->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('transactions.show',$transaction->id) }}">Show</a>
                    @can('transaction-edit')
                    <a class="btn btn-primary" href="{{ route('transactions.edit',$transaction->id) }}">Edit</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('transaction-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>

    {!! $transactions->links() !!}
@endsection