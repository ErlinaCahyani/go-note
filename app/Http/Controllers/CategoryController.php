<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $categories = Category::orderBy('id','DESC')->paginate(5);
        return view('indexCategory',compact('categories'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('createCategory');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
         'category_name' => 'required',
         'type' => 'required',
         'desc' => 'required',
         ]);

         $categories = Category::create($request->all());
         return redirect()->route('category.index')->with('success','categories successfully added');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('editCategory',compact('category')); 
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
         'category_name' => 'required',
         'type' => 'required',
         ]);
             
         $categories = Category::find($id)->update($request->all());
         return redirect()->route('category.index')->with('success','categories successfully updated');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('category.index')->with('success','categories successfully deleted');
    }
}
