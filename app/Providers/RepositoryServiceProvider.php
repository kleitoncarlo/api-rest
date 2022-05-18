<?php

namespace App\Providers;

use App\Interfaces\CategoriaRepositoryInterface;
use App\Interfaces\ProdutoRepositoryInterface;
use App\Repositories\CategoriaRepository;
use App\Repositories\ProdutoRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind(ProdutoRepositoryInterface::class, ProdutoRepository::class);
        $this->app->bind(CategoriaRepositoryInterface::class, CategoriaRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
    }
}
