@extends('layouts.app')
@section('content')
<div>
	<a href="{{ route('transaction.create') }}">Add New Transaction</a>
	 @if ($message = Session::get('success'))
		 <div>
		 	{{ $message }}
		 </div>
	 @endif

	 {!! Form::open(array('route' => 'transaction.filterDate','method'=>'POST')) !!}
		<div>
		    <strong>Start Date:</strong>
		    <br>
		    {!! Form::date('start_date', \Carbon\Carbon::now()); !!}
		    <br>
		    <strong>End Date:</strong>
		    <br>
		    {!! Form::date('end_date', \Carbon\Carbon::now()); !!}
		    <br>
		    <button type="submit" class="btn btn-primary">Filter</button>
		</div>
	{!! Form::close() !!}
	 <table>
		 <thead>
			 <tr>
				 <th width="70px">No</th>
				 <th>Transaction Type</th>
				 <th>Category</th>
				 <th>Amount</th>
				 <th>Description</th>
				 <th width="200px">Action</th>
			 </tr>
		 </thead>
		 <tbody>
		 @foreach ($transactions as $key => $transaction)
			 <tr>
				 <td>{{ ++$i }}</td>
				 <td>{{ $transaction->trans_type }}</td>
				 <td>{{ $transaction->category }}</td>
				 <td>{{ $transaction->amount }}</td>
				 <td>{{ $transaction->desc }}</td>
				 <td>
					 <a class="btn btn-primary"
					href="{{ route('transaction.edit',$transaction->id) }}">Edit</a>
					{!! Form::open(['method' => 'DELETE','route' =>
					['transaction.destroy', $transaction->id],'style'=>'display:inline']) !!}
					 {!! Form::submit('Delete', ['class' => 'btn btndanger'])
					!!}
					 {!! Form::close() !!}
				 </td>
			 </tr>
		 @endforeach
		 </tbody>
		 </table>
	</div>
@endsection