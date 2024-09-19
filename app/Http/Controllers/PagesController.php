<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Customer;
use App\Category;

class PagesController extends Controller
{
    public function dashboard()
    {
    	$project_list= Project::paginate(5);
    	$service_list= Category::paginate(5);
    	$customer_list=Customer::paginate(5);

    	return view('pages.dashboard',compact('project_list','service_list','customer_list'));
    }
}
