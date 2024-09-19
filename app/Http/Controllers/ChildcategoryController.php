<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Child_Category;
use Session;

class Childchild_categoryController extends Controller
{
    public function index(Child_Category $child_category)
    {
        $child_list = Child_Category::OrderBy($child_category->category->category_name)->paginate(10);
        return view('child_category.index',compact('child_list'));
    }


    public function create()
    {
        return view('child_category.create');
    }


    public function store(Request $request)
    {
        Child_Category::create($request->all());
        Session::flash('flash_message', 'Data berhasil disimpan.');

        return redirect()->route('child_category_index');

    }

    public function show($id)
    {
        //
    }


    public function edit(Child_Category $child_category)
    {
        return view('child_category.edit',compact('child_category'));
    }


    public function update(Child_Category $child_category, Request $request)
    {
        $child_category->update($request->all());
        Session::flash('flash_message', 'Data berhasil diupdate.');

        return redirect()->route('child_category_index');
    }


    public function destroy(Child_Category $child_category)
    {
        $child_category->delete();
        Session::flash('flash_message', 'Data  berhasil dihapus.');
        Session::flash('penting', true);

        return redirect()->route('child_category_index');
    }
}