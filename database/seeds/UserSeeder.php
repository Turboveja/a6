<?php

namespace Database\Seeders;

use App\Models\Grupo;
use App\Models\Medio;
use App\Models\Promotor;
use App\Models\Recinto;
use App\User;
use Faker\Factory;
use Faker\Guesser\Name;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creación de usuarios de prueba
        User::create([
            'name' => 'Matias Prats',
            'email' => 'matias.prats@test.com',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'name' => 'María Robledales',
            'email' => 'maria.robledales@test.com',
            'password' => bcrypt('123456')
        ]);

        //Creamos varios más con datos mock
        $faker = Factory::create();
        for($i = 0; $i < 30; $i++){
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('123456')
            ]);
        }

        //Resto de data de la app
        Promotor::create([
            'nombre' => 'Promotor 1',
            'email' => 'promotor.one@test.com'
        ]);
        Promotor::create([
            'nombre' => 'Promotor 2',
            'email' => 'promotor.two@test.com'
        ]);

        Medio::create([
            'nombre' => 'publicidad 1',
        ]);
        Medio::create([
            'nombre' => 'publicidad 2',
        ]);
        Medio::create([
            'nombre' => 'publicidad 3',
        ]);

        Recinto::create([
            'nombre' => 'O2 London',
            'coste_alquiler' => 1000,
            'precio_entrada' => 10
        ]);
        Recinto::create([
            'nombre' => 'La Cubierta',
            'coste_alquiler' => 2000,
            'precio_entrada' => 15
        ]);

        Grupo::create([
            'nombre' => 'Lions Way',
            'cache' => 1000
        ]);
        Grupo::create([
            'nombre' => 'VLK',
            'cache' => 1000
        ]);
        Grupo::create([
            'nombre' => 'Los Gandules',
            'cache' => 5000
        ]);
    }
}
