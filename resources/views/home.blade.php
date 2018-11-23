@extends('layouts.app')
@section('content')
Pemasukan  : 
<?php
echo $data['pemasukan'];?>
<br>
Pengeluaran :
<?php echo $data['pengeluaran'];?>
<br>
Saldo :
<?php echo $data['saldo'];?>
@endsection
