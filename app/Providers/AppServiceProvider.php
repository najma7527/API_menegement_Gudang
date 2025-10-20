<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Binding Barang
        $this->app->bind(\Repositories\Interfaces\BarangRepositoryInterface::class, \Repositories\Eloquent\BarangRepository::class);
        // Binding Katagori
        $this->app->bind(\Repositories\Interfaces\KatagoriInterface::class, \Repositories\Eloquent\KatagoriRepository::class);
        // Binding Transaksi
        $this->app->bind(\Repositories\Interfaces\CrudInterface::class, \Repositories\Eloquent\TransaksiRepository::class);
        // Binding User
        $this->app->bind(\Repositories\Eloquent\UserRepository::class, \Repositories\Eloquent\UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
