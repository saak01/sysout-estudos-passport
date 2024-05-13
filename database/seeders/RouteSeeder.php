<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['group' => 'Loja','action' => 'Listar', 'key' => 'shop.index'],
            ['group' => 'Loja','action' => 'Criar', 'key' => 'shop.create'],
            ['group' => 'Loja','action' => 'Editar', 'key' => 'shop.update'],
            ['group' => 'Loja','action' => 'Remover', 'key' => 'shop.delete'],
        ];

        Route::insert($data);
    }
}
