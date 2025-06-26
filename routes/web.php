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
Route::get('/', 'WelcomeController@index')->name('welcome');

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

// Inventory Management
Route::get('inventory',[
    'uses' => 'InventoryController@index',
    'as' => 'inventory_index',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::get('inventory/add',[
    'uses' => 'InventoryController@create',
    'as' => 'inventory_create',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::post('inventory/add',[
    'uses' => 'InventoryController@store',
    'as' => 'inventory_store',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::get('inventory/edit/{id}',[
    'uses' => 'InventoryController@edit',
    'as' => 'inventory_edit',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::patch('inventory/edit/{id}',[
    'uses' => 'InventoryController@update',
    'as' => 'inventory_update',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::delete('inventory/delete/{id}',[
    'uses' => 'InventoryController@destroy',
    'as' => 'inventory_delete',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);


// Inventory Categories
Route::get('inventory/categories', [
    'uses' => 'InventoryCategoryController@index',
    'as' => 'inventory_categories.index',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::get('inventory/categories/create', [
    'uses' => 'InventoryCategoryController@create',
    'as' => 'inventory_categories.create',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::post('inventory/categories', [
    'uses' => 'InventoryCategoryController@store',
    'as' => 'inventory_categories.store',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::get('inventory/categories/{id}/edit', [
    'uses' => 'InventoryCategoryController@edit',
    'as' => 'inventory_categories.edit',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::patch('inventory/categories/{id}', [
    'uses' => 'InventoryCategoryController@update',
    'as' => 'inventory_categories.update',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::delete('inventory/categories/{id}', [
    'uses' => 'InventoryCategoryController@destroy',
    'as' => 'inventory_categories.destroy',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

// Inventory Locations
Route::get('inventory/locations', [
    'uses' => 'InventoryLocationController@index',
    'as' => 'inventory_locations.index',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::get('inventory/locations/create', [
    'uses' => 'InventoryLocationController@create',
    'as' => 'inventory_locations.create',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::post('inventory/locations', [
    'uses' => 'InventoryLocationController@store',
    'as' => 'inventory_locations.store',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::get('inventory/locations/{id}/edit', [
    'uses' => 'InventoryLocationController@edit',
    'as' => 'inventory_locations.edit',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::patch('inventory/locations/{id}', [
    'uses' => 'InventoryLocationController@update',
    'as' => 'inventory_locations.update',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::delete('inventory/locations/{id}', [
    'uses' => 'InventoryLocationController@destroy',
    'as' => 'inventory_locations.destroy',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

// Inventory Suppliers
Route::get('inventory/suppliers', [
    'uses' => 'SupplierController@index',
    'as' => 'inventory_suppliers.index',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::get('inventory/suppliers/create', [
    'uses' => 'SupplierController@create',
    'as' => 'inventory_suppliers.create',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::post('inventory/suppliers', [
    'uses' => 'SupplierController@store',
    'as' => 'inventory_suppliers.store',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::get('inventory/suppliers/{id}/edit', [
    'uses' => 'SupplierController@edit',
    'as' => 'inventory_suppliers.edit',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::patch('inventory/suppliers/{id}', [
    'uses' => 'SupplierController@update',
    'as' => 'inventory_suppliers.update',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::delete('inventory/suppliers/{id}', [
    'uses' => 'SupplierController@destroy',
    'as' => 'inventory_suppliers.destroy',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

// Purchase Orders
Route::get('purchase_orders', [
    'uses' => 'PurchaseOrderController@index',
    'as' => 'purchase_orders.index',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::get('purchase_orders/create', [
    'uses' => 'PurchaseOrderController@create',
    'as' => 'purchase_orders.create',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::post('purchase_orders', [
    'uses' => 'PurchaseOrderController@store',
    'as' => 'purchase_orders.store',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::get('purchase_orders/{id}', [
    'uses' => 'PurchaseOrderController@show',
    'as' => 'purchase_orders.show',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::get('purchase_orders/{id}/edit', [
    'uses' => 'PurchaseOrderController@edit',
    'as' => 'purchase_orders.edit',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::patch('purchase_orders/{id}', [
    'uses' => 'PurchaseOrderController@update',
    'as' => 'purchase_orders.update',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::delete('purchase_orders/{id}', [
    'uses' => 'PurchaseOrderController@destroy',
    'as' => 'purchase_orders.destroy',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

// Sales
Route::get('sales', [
    'uses' => 'SaleController@index',
    'as' => 'sales.index',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::get('sales/create', [
    'uses' => 'SaleController@create',
    'as' => 'sales.create',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::post('sales', [
    'uses' => 'SaleController@store',
    'as' => 'sales.store',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::get('sales/{id}/edit', [
    'uses' => 'SaleController@edit',
    'as' => 'sales.edit',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::patch('sales/{id}', [
    'uses' => 'SaleController@update',
    'as' => 'sales.update',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

Route::delete('sales/{id}', [
    'uses' => 'SaleController@destroy',
    'as' => 'sales.destroy',
    'middleware' => 'roles',
    'roles' => ['admin','author']
]);

// POS Routes
Route::group(['prefix' => 'pos', 'as' => 'pos.'], function () {
    Route::get('/', 'PosController@index')->name('index');
    Route::get('/search', 'PosController@search')->name('search');
    Route::post('/add-to-cart', 'PosController@addToCart')->name('addToCart');
    Route::post('/update-cart', 'PosController@updateCart')->name('updateCart');
    Route::post('/remove-from-cart', 'PosController@removeFromCart')->name('removeFromCart');
    Route::post('/checkout', 'PosController@checkout')->name('checkout');
});