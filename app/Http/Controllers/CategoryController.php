<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Child_Category;
use Session;


class CategoryController extends Controller
{
    public function index()
    {
        $category_list = Category::paginate(10);

        return view('category.index',compact('category_list'));
    }


    public function create()
    {
        return view('category.create');
    }


    public function store(Request $request)
    {
        Category::create($request->all());
        Session::flash('flash_message', 'Data category berhasil disimpan.');

        return redirect()->route('category_index');

    }

    public function show(Category $category)
    {
 
        return view('category.show',compact('category'));
    }


    public function edit(Category $category)
    {
        return view('category.edit',compact('category'));
    }


    public function update(Category $category, Request $request)
    {
        $category->update($request->all());
        Session::flash('flash_message', 'Data category berhasil diupdate.');

        return redirect()->route('category_index');
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        $category= Category::find($id);
        $category->delete();
        Session::flash('flash_message', 'Data kategory berhasil dihapus.');
        Session::flash('penting', true);
    
    }

    // ================================================

    public function add(Request $request)
        {
            $data = new Child_Category;
            $data ->id_category = $request ->id_category;
            $data ->child_category_name = $request ->child_category_name;
            $data ->child_category_desc = $request ->child_category_desc;
            $data ->save();
            Session::flash('flash_message', 'Data berhasil ditambah.');
            return back();
        }
 
        /*
         * View data
         */
        public function view(Request $request)
        {
            if($request->ajax()){
                $id = $request->id;
                $info = Child_Category::find($id);
                //echo json_decode($info);
                return response()->json($info);
            }
        }
 
        /*
        *   Update data
        */
        public function updateChild(Request $request)
        {
            $id = $request ->edit_id;
            $data = Child_Category::find($id);
            $data ->id_category = $request ->id_category;
            $data ->child_category_name = $request ->child_category_name;
            $data ->child_category_desc = $request ->child_category_desc;
            $data -> save();

            return back();
        }
 
        /*
        *   Delete record
        */
        public function deleteChild(Request $request)
        {
            $id = $request->id;
            $data = Child_Category::find($id);
            $response = $data ->delete();
            if($response)
                echo "Record Deleted successfully.";
            else
                echo "There was a problem. Please try again later.";
        }
}