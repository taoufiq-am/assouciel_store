<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Permission::create(['name' => 'Gestion des soldes']);
        // Permission::create(['name' => 'Edition des statistiques']);
        // Permission::create(['name' => 'Gérer l\'état d\'une commande']);
        // Permission::create(['name' => 'Gestion des produits']);
        // Permission::create(['name' => 'Gestion des catégories']);
        // Permission::create(['name' => 'Gestion des fournisseurs']);
        // Permission::create(['name' => 'Gestion des utilisateurs']);
        // Permission::create(['name' => 'Gestion des rôles']);

        // Role::create(['name' => 'commercial'])
        //     ->givePermissionTo([
        //         'Gestion des soldes',
        //         'Edition des statistiques',
        //         'Gérer l\'état d\'une commande',
        //     ]);

        // Role::create(['name' => 'magasinier'])
        //     ->givePermissionTo([
        //         'Gestion des produits',
        //         'Gestion des catégories',
        //         'Gestion des fournisseurs',
        //     ]);

        // Role::create(['name' => 'admin'])
        //     ->givePermissionTo([
        //         'Gestion des utilisateurs',
        //         'Gestion des rôles',
        //     ]);

    }
}
