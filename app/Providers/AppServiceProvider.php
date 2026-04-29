<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Define quem é o Almoxarifado Central (Polícia Científica)
        Gate::define('admin-central', function (User $user) {
            return $user->tipo_usuario === 'central';
        });

        // Define quem pode analisar pedidos
        Gate::define('analisar-pedido', function (User $user) {
            return in_array($user->tipo_usuario, ['central', 'instituto']);
        });
    }
}