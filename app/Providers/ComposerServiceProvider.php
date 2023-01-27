<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //As categorias ficaram disponiveis para todas as views. Isso é muito útil pq evita ter que copiar e colar o mesmo código em todos os métodos que precisam essa váriavel.
        // $categories = Category::all(['name', 'slug']);

        // O share compartilha um chave e valor com todas as views
        // view()->share('categories', $categories);



        // Usando o composer para compartilhar as categorias com todas as views

        // Compartilhando as categorias com um array de views
        /* view()->composer(['welcome', 'single'], function($view) use($categories){
            $view->with('categories', $categories);
        }); */

        //Compartilhando as categorias com a view welcome
        /* view()->composer('welcome', function($view) use($categories){
            $view->with('categories', $categories);
        }); */
        
        // Compartilhando as categorias com todas as views
        /* view()->composer('*', function($view) use($categories){
            $view->with('categories', $categories);
        }); */

        // $ php artisan make:provider ComposerServiceProvider. 
        // tem que Registrar o provider ComposerServiceProvider em app.php que fica na pasta config

        view()->composer('layouts.front', 'App\Http\Views\CategoryViewComposer@compose');
    }
}
