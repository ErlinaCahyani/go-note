<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=auth()->user()->id;
        $pengeluaran = Transaction::where('user_id', $user_id)->where('trans_type', 'pengeluaran')->sum('amount');
        $pemasukan = Transaction::where('user_id', $user_id)->where('trans_type', 'pemasukan')->sum('amount');
        $saldo = User::select('saldo')->where('id', $user_id)->get();
        $data=array(
            'pemasukan'=>$pemasukan,
            'pengeluaran'=>$pengeluaran,
            'saldo'=>$saldo,
        );
        return view('home', compact('data'));
    }
}
