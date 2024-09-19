<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Child_Category;
use Session;
use Response;

class ProjectController extends Controller
{
    public function index()
    {
        $project_list= Project::paginate(5);
      
        return view('project.index',compact('project_list'));
    }


    public function create()
    {
        return view('project.create');
    }


    public function store(Request $request)
    {
        Project::create($request->all());
        Session::flash('flash_message', 'Data project berhasil disimpan.');

        return redirect()->route('project_index');

    }

    public function show(Project $project)
    {
        return view('project.show',compact('project'));
    }


    public function edit(Project $project)
    {
        return view('project.edit',compact('project'));
    }


    public function update(Project $project, Request $request)
    {
        $project->update($request->all());
        Session::flash('flash_message', 'Data project berhasil diupdate.');

        return redirect()->route('project_index');
    }


    public function destroy(Request $request)
    {
        $id=$request->id;
        $project= Project::find($id);
        $project->delete();
        Session::flash('flash_message', 'Data project berhasil dihapus.');
        Session::flash('penting', true);

        // return redirect()->route('project_index');
    }

    public function child(Request $request)
    {
       $id=$request->input('option');
       $child = Child_Category::Where('id_category',$id)->pluck('child_category_name','id');
        //$kota = Indonesia::findC($id, ['cities'])->lists('cities');

        return Response::make($child);
    }
}