<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dashboard',[
	'uses'	=>'PagesController@dashboard',
	'as'	=> 'dashboard',
	'middleware' => 'roles',
	'roles'	=>['admin','author']
	]);

Route::get('ajax/getchild',[
	'uses'	=> 'ProjectController@child',
	'as'	=> 'getchild',
	// 'middleware'=>'roles',
	// 'roles'	=>['admin','autor']
	]);

Route::get('customer',[
	'uses'	=>'CustomerController@index',
	'as'	=> 'customer_index',
	'middleware' => 'roles',
	'roles'	=>['author','admin']
	]);

Route::get('customer/add',[
	'uses'	=>'CustomerController@create',
	'as'	=> 'customer_create',
	'middleware' => 'roles',
	'roles'	=>['admin','author']
	]);

Route::get('customer/detail/{customer}',[
	'uses'	=>'CustomerController@show',
	'as'	=>'customer_show',
	'middleware'	=>'roles',
	'roles'	=>['admin','author']
	]);

Route::post('customer/add',[
	'uses'	=>'CustomerController@store',
	'as'	=> 'customer_store',
	'middleware' => 'roles',
	'roles'	=>['admin','author']
	]);

Route::get('customer/edit/{customer}',[
	'uses'	=>'CustomerController@edit',
	'as'	=>'customer_edit',
	'middleware'	=>'roles',
	'roles'	=>['admin','author']
	]);
Route::patch('customer/edit/{customer}',[
	'uses'	=>'CustomerController@update',
	'as'	=>'customer_update',
	'middleware'	=>'roles',
	'roles'	=>['admin','author']
	]);

Route::post('customer/delete',[
	'uses'	=>'CustomerController@destroy',
	'as'	=>'customer_delete',
	'middleware'	=>'roles',
	'roles'	=>['admin','author']
	]);


// ===============================================

Route::get('project',[
	'uses'	=>'ProjectController@index',
	'as'	=> 'project_index',
	'middleware' => 'roles',
	'roles'	=>['admin','author']
	]);

Route::get('project/add',[
	'uses'	=>'ProjectController@create',
	'as'	=> 'project_create',
	'middleware' => 'roles',
	'roles'	=>['admin','author']
	]);

Route::post('project/add',[
	'uses'	=>'ProjectController@store',
	'as'	=> 'project_store',
	'middleware' => 'roles',
	'roles'	=>['admin','author']
	]);

Route::get('project/detail/{project}',[
	'uses'	=>'ProjectController@show',
	'as'	=>'project_show',
	'middleware'	=>'roles',
	'roles'	=>['admin','author']
	]);

Route::get('project/edit/{project}',[
	'uses'	=>'ProjectController@edit',
	'as'	=>'project_edit',
	'middleware'	=>'roles',
	'roles'	=>['admin','author']
	]);
Route::patch('project/edit/{project}',[
	'uses'	=>'ProjectController@update',
	'as'	=>'project_update',
	'middleware'	=>'roles',
	'roles'	=>['admin','author']
	]);

Route::post('project/delete',[
	'uses'	=>'ProjectController@destroy',
	'as'	=>'project_delete',
	'middleware'	=>'roles',
	'roles'	=>['admin']
	]);

// ===============================================

Route::get('category',[
	'uses'	=>'CategoryController@index',
	'as'	=> 'category_index',
	'middleware' => 'roles',
	'roles'	=>['admin','author']
	]);

Route::get('category/add',[
	'uses'	=>'CategoryController@create',
	'as'	=> 'category_create',
	'middleware' => 'roles',
	'roles'	=>['admin','author']
	]);

Route::post('category/add',[
	'uses'	=>'CategoryController@store',
	'as'	=> 'category_store',
	'middleware' => 'roles',
	'roles'	=>['admin','author']
	]);
Route::get('category/detail/{category}',[
	'uses'	=>'CategoryController@show',
	'as'	=>'category_show',
	'middleware'	=>'roles',
	'roles'	=>['admin','author']
	]);

Route::get('category/edit/{category}',[
	'uses'	=>'CategoryController@edit',
	'as'	=>'category_edit',
	'middleware'	=>'roles',
	'roles'	=>['admin','author']
	]);
Route::patch('category/edit/{category}',[
	'uses'	=>'CategoryController@update',
	'as'	=>'category_update',
	'middleware'	=>'roles',
	'roles'	=>['admin','author']
	]);

Route::post('category/delete',[
	'uses'	=>'CategoryController@destroy',
	'as'	=>'category_delete',
	'middleware'	=>'roles',
	'roles'	=>['admin','author']
	]);

// =======================Auth====================
Route::get('signUp',[
	'uses'	=>'AuthController@getsignUpPage',
	'as'	=>'signUp',
	'middleware'	=>'roles',
	'roles'	=>['admin']
	]);

Route::post('signUp',[
	'uses'	=>'AuthController@postsignUp',
	'as'	=>'signUp',
	'middleware'	=>'roles',
	'roles'	=>['admin']
	]);
Route::get('signIn',[
	'uses'	=>'AuthController@getsigninPage',
	'as'	=>'signIn',
	]);
Route::post('signIn',[
	'uses'	=>'AuthController@postsignIn',
	'as'	=>'signIn',
	]);

Route::get('logout',[
	'uses'	=>'AuthController@getlogOut',
	'as'	=>'logout',
	]);

// ====================User Managementt===============
Route::get('admin/user',[
	'uses'	=>'AdminController@listUser',
	'as'	=>'listUser',
	'middleware'=>'roles',
	'roles'	=>['admin']
	]);
Route::post('admin/user',[
	'uses'	=>'AdminController@assignRoles',
	'as'	=>'assignRole',
	'middleware'	=>'roles',
	'roles'	=>['admin']
	]);
Route::get('admin/user/create',[
	'uses'	=>'AdminController@addForm',
	'as'	=>'user_create',
	'middleware'=>'roles',
	'roles'	=>['admin']
	]);
Route::post('admin/user/create',[
	'uses'	=>'AdminController@add',
	'as'	=>'user_store',
	'middleware'=>'roles',
	'roles'	=>['admin']
	]);

Route::get('admin/user/delete/{id}',[
	'uses'	=>'AdminController@deleteUser',
	'as'	=>'user_delete',
	'middleware'=>'roles',
	'roles'	=>['admin']
	]);

// =====================================
Route::post('crud', 'CategoryController@add')->name('child_add');
Route::get('crud/view', 'CategoryController@view')->name('child_view');
Route::post('crud/update', 'CategoryController@updateChild')->name('child_update');
Route::post('crud/delete', 'CategoryController@deleteChild')->name('child_delete');

// =================
Route::post('contact', 'CustomerController@add')->name('contact_add');
Route::get('contact/view', 'CustomerController@view')->name('contact_view');
Route::post('contact/update', 'CustomerController@updateContact')->name('contact_update');
Route::post('contact/delete', 'CustomerController@deleteContact')->name('contact_delete');


Auth::routes();

Route::get('/home', 'HomeController@index');
