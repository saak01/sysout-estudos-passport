<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Route;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminGroup = new Group();
        $adminGroup->name = 'Administrador';
        $adminGroup->save();

        $customerGroup = new Group();
        $customerGroup-> name = 'Cliente';
        $customerGroup-> save();

        $routes = Route::all();

        //Grupo de admin tem acesso a todas as rotas
        $adminGroup->routes()->attach($routes);
        //Grupo de clientes tem acesso as rotas de listagem
        $customerGroup->routes()->attach($routes->where('key','shop.index'));



    }
}
