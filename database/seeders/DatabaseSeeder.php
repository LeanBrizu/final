<?php

namespace Database\Seeders;

/**
 * Importación comentada de WithoutModelEvents. Descomentar si necesitas desactivar temporalmente
 * los eventos de modelos al ejecutar seeders. Esto puede ser útil para evitar efectos secundarios
 * no deseados de los eventos de modelos en la lógica de negocio durante la semilla de datos.
 * Utilizar con precaución para asegurar la consistencia de los datos.
 **/
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Creación de registros de prueba de 'noticias' y 'contactos'.
        // Actualmente deshabilitado para evitar que se ejecute.
        if (0) {
            for ($i=0; $i<=10; $i++) {
                DB::table('noticias')->insert([
                    'titulo'      => $faker->sentence(),
                    'copete'      => $faker->sentence(),
                    'descripcion' => $faker->text,
                    'estado'      => $faker->numberBetween(0, 1),
                    'imagen'      => $faker->imageUrl(640, 480, 'animals', true), // genera una URL de imagen aleatoria
                    'created_at'  => $faker->datetime,
                    'updated_at'  => $faker->datetime
                ]);
                DB::table('contactos')->insert([
                    'nombre'     => $faker->firstname(),
                    'apellido'   => $faker->lastName(),
                    'email'      => $faker->email(),
                    'telefono'   => $faker->phoneNumber(),
                    'mensaje'    => $faker->realTextBetween($minNbChars = 160, $maxNbChars = 200, $indexSize = 2),
                    'created_at' => $faker->datetime,
                    'updated_at' => $faker->datetime
                ]);
            }
        }

        // Creación de registro de un usuario de prueba.
        DB::table('usuarios')->insert([
            'name'       => 'usuario_prueba',
            'password'   => Hash::make('contraseña_secreta'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
