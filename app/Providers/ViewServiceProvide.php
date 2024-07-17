<?php
 
 namespace App\Providers;

 use App\Http\View\Composer\MenuComposer;
 use Illuminate\Support\Facades\View;
 use Illuminate\Support\ServiceProvider;
 
class ViewServiceProvide extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }
 
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Using class based composers...
        //truyền menuComposer vào file header
       View::composer('header',MenuComposer::class);
    }
}