<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Request;

class NavbarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('title', 'CKS Project');
        
         $halaman = '';
        if (Request::segment(1) == 'dashboard') {
          $halaman = 'dashboard';
        }

        if (Request::segment(1) == 'project') {
          $halaman = 'project';
        }

        if (Request::segment(1) == 'customer') {
          $halaman = 'customer';
        }

        if (Request::segment(1) == 'category') {
          $halaman = 'category';
        }

        // if (Request::segment(1) == 'user') {
        //   $halaman = 'user';
        // }

        view()->share('halaman', $halaman);
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
