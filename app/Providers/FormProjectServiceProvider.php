<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Customer;
use App\Child_Category;

class FormProjectServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
        view()->composer('project.create', function($view) {
            $view->with('list_category', Category::pluck('category_name', 'id'));
            $view->with('list_customer', Customer::pluck('customer_name', 'id'));
            $view->with('list_child', Child_Category::pluck('child_category_name', 'id'));

        });

          view()->composer('project.edit', function($view) {
            $view->with('list_category', Category::pluck('category_name', 'id'));
            $view->with('list_customer', Customer::pluck('customer_name', 'id'));
            $view->with('list_child', Child_Category::pluck('child_category_name', 'id'));

        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
