@extends('layouts.app')
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
    {!! Form::select('trans_type', ['Pemasukan' => 'Pemasukan', 'Pengeluaran' => 'Pengeluaran'], 'default', array('onchange' => 'getCategory(this)')) !!}
    <br>
    <strong>Category Transaction:</strong>
    <br>
    <div id="category_id"></div>
    {!! Form::text('category_id', null, array('placeholder' => 'category_id','class' => 'form-control')) !!}
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
<button id="subt" class="btn btn-primary">ADD</button>
<script>
        function getCategory($type){
            $.ajax({
           type:'GET',
           url:'/getCategory/' + $type,
           data: {
            type : $('#trans_type').val(),
            },
           success:function(data){
              $("#category").html(data.categories);
           }
        });
        }
  </script>
@endsection 
