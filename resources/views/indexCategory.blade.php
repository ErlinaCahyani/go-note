@extends('layouts.app')
@section('content')
<div>
	<a href="{{ route('category.create') }}">Add New Category</a>
	 @if ($message = Session::get('success'))
		 <div>
		 	{{ $message }}
		 </div>
	 @endif
	 <table>
		 <thead>
			 <tr>
				 <th width="70px">No</th>
				 <th>Category Name</th>
				 <th>Type</th>
				 <th>Description</th>
				 <th width="200px">Action</th>
			 </tr>
		 </thead>
		 <tbody>
		 @foreach ($categories as $key => $category)
			 <tr>
				 <td>{{ ++$i }}</td>
				 <td>{{ $category->category_name }}</td>
				 <td>{{ $category->type }}</td>
				 <td>{{ $category->desc }}</td>
				 <td>
					 <a class="btn btn-primary"
					href="{{ route('category.edit',$category->id) }}">Edit</a>
					{!! Form::open(['method' => 'DELETE','route' =>
					['category.destroy', $category->id],'style'=>'display:inline']) !!}
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