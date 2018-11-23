@extends('layouts.app')
@section('title')
<h1>Add<span> New Category</span></h1>
@section('content')
<div><a class="btn btn-success" href="{{ route('transaction.index') }}"> Back</a></div>

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

{!! Form::open(array('route' => 'transaction.store','method'=>'POST')) !!}
<div>
    <strong>Transaction Type:</strong>
    <br>
    {!! Form::select('trans_type', ['Pemasukan' => 'Pemasukan', 'Pengeluaran' => 'Pengeluaran'],array('id' => 'trans_type')) !!}
    <br>
    <strong>Category Transaction:</strong>
    <br>
    <div id="category"></div>
    
    <br>
    <strong>Amount:</strong>
    <br>
    {!! Form::text('amount', null, array('placeholder' => 'Amount','class' => 'form-control')) !!}
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
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
     $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN':'<?php echo csrf_token() ?>'
            }
        });
        $('select[name="category_id"]').on('change', function() {
        $.ajax({
           type:'POST',
           url:'/getCategory',
           data: $('#trans_type').val(),
           success:function(data){
              $("#category").html(data.categories);
           }
        });
        });
     });
  </script>