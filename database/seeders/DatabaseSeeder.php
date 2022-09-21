<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;


use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

    	for ($i=0;$i<=10;$i++) {
            DB::table('noticias')->insert([
                'titulo' => $faker->sentence(),
                'copete' => $faker->sentence(),
                'descripcion' => $faker->text,
              //'estado' => $faker->numberBetween(0, 1),
                'created_at' => $faker->datetime,              
                'updated_at' =>$faker->datetime
            ]);
            DB::table('contactos')->insert([
                'nombre' => $faker->firstname(),
                'apellido' => $faker->lastName(),
                'email' => $faker->email(),
                'telefono' => $faker->phoneNumber(),
                'mensaje' => $faker->realTextBetween($minNbChars = 160, $maxNbChars = 200, $indexSize = 2),
                'created_at' => $faker->datetime,              
                'updated_at' =>$faker->datetime
            ]);
        }

    }
}
