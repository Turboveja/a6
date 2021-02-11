<?php

namespace Database\Seeders;

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
    }
}
