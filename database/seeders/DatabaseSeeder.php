<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

    	for ($i=0;$i<=25;$i++) {
            DB::table('noticias')->insert([
                'titulo' => $faker->text,
                'copete' => $faker->text,
                'descripcion' => $faker->text,
                'estado' => $faker->numberBetween(0, 1),
                'updated_at' =>$faker->datetime,
                'created_at' => $faker->datetime              
            ]);
        }
    }
}
