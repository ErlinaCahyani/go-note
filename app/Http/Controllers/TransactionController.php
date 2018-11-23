<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Transaction;
use App\Category;

class TransactionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user_id=auth()->user()->id;
        
        $transactions = Transaction::where('user_id', $user_id)->whereYear('created_at', '=',date('Y'))->whereMonth('created_at', '=', date('m'))->get();
        return view('indexTransaction',compact('transactions'))->with('i');
    }
    public function filterDate(Request $request){
        $user_id=auth()->user()->id;
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $transactions = Transaction::where('user_id', $user_id)->whereDate('created_at', '>=',$start_date)->whereDate('created_at', '<=',$end_date)->get();
        return view('indexTransaction',compact('transactions'))->with('i', $start_date, $end_date);
    }
    public function getCategory($type){
        $categories = Category::where('type', $type);
        return response()->json(array('categories'=> $categories), 200);
    }

    public function create()
    {
        return view('createTransaction');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
         'trans_type' => 'required',
         'category_id' => 'required',
         'amount' => 'required',
         ]);
        $request['user_id'] = auth()->user()->id;
         $transaction = Transaction::create($request->all());
         return redirect()->route('transaction.index')->with('success','transaction successfully added');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $transaction = Transaction::find($id);
        return view('editTransaction',compact('transaction')); 

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
         'trans_type' => 'required',
         'category_id' => 'required',
         'amount' => 'required',
         ]);
         
         $transaction = Transaction::find($id)->update($request->all());
         return redirect()->route('transaction.index')->with('success','transaction successfully updated');
    }

    public function destroy($id)
    {
        Transaction::find($id)->delete();
        return redirect()->route('transaction.index')->with('success','transaction successfully deleted');
    }
}
