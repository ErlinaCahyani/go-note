@extends('layouts.app')
@section('title')
<h1>Add<span> New Category</span></h1>
@section('content')
<div><a class="btn btn-success" href="{{ route('category.index') }}"> Back</a></div>

@if (count($errors) > 0)
<div>
    <strong>Sorry!</strong> Something wrong with your input data.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{!! Form::open(array('route' => 'category.store','method'=>'POST')) !!}
<div>
    <strong>Category Name:</strong>
    <br>
    {!! Form::text('category_name', null, array('placeholder' => 'Category Name','class' => 'form-control')) !!}
    <br>
    <strong>Type:</strong>
    <br>
    {!! Form::select('type', ['Pemasukan' => 'Pemasukan', 'Pengeluaran' => 'Pengeluaran']) !!}
    <br>
    <strong>Description:</strong>
    <br>
    {!! Form::text('desc', null, array('placeholder' => 'Description','class' => 'form-control')) !!}
    <br>
    <button type="submit" class="btn btn-primary">ADD</button>
    <button type="reset" class="btn btn-warning">CANCEL</button>
</div>
{!! Form::close() !!}
@endsection 