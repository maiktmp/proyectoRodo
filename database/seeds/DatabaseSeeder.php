<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_type')->insert([
            ['name' => 'Administrador'],
            ['name' => 'Alumno'],
            ['name' => 'Profesor'],
        ]);
        DB::table('position')->insert([
            ['name' => 'Aceptado'],
            ['name' => 'Rechazado']
        ]);
        DB::table('status')->insert([
            ['name' => 'En revisión por el asesor'],
            ['name' => 'En revisión'],
            ['name' => 'Rechazado por el asesor'],
            ['name' => 'Rechazado por revisor'],
            ['name' => 'Aceptado'],
        ]);
        DB::table('state')->insert([
            ['name' => 'Pendiente de asignación'],
            ['name' => 'Pendiente de aceptar por el asesor'],
            ['name' => 'En revisión'],
            ['name' => 'En correción por el alumno'],
            ['name' => 'Concluido'],
            ['name' => 'Retrasado']
        ]);
        DB::table('rol')->insert([
            ['name' => 'Alumno'],
            ['name' => 'Asesor'],
            ['name' => 'Profesor']
        ]);

        $faker = \Faker\Factory::create('es_MX');
        DB::table('user')->insert([
            'name' => 'Miguel',
            'last_name' => 'Pereira Suarez',
            'username' => 'alu_14280487',
            'password' => bcrypt('pw0000'),
            'email' => "aluItt@ittol.com.mx",
            'no_control' => "14280487",
            'carrera' => "Ing. en Sistemas Computacionales ",
            'fk_id_user_type' => "2",

        ]);
        DB::table('user')->insert([
            'name' => 'Carlos',
            'last_name' => 'Perez Perez',
            'username' => 'alu_14280488',
            'password' => bcrypt('pw0000'),
            'email' => "aluItt@ittol.com.mx",
            'no_control' => "14280487",
            'carrera' => "Ing. en Sistemas Computacionales ",
            'fk_id_user_type' => "2",
        ]);
        DB::table('user')->insert([
            [
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => 'profe_1234',
                'password' => bcrypt('pw0000'),
                'email' => "profe1Itt@ittol.com.mx",
                'fk_id_user_type' => "3",
            ],
            [
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => 'profe_456',
                'password' => bcrypt('pw0000'),
                'email' => "profe2Itt@ittol.com.mx",
                'fk_id_user_type' => "3",
            ],
            [
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => 'profe_789',
                'password' => bcrypt('pw0000'),
                'email' => "profe3Itt@ittol.com.mx",
                'fk_id_user_type' => "3",
            ],
            [
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => 'profe_741',
                'password' => bcrypt('pw0000'),
                'email' => "profe4Itt@ittol.com.mx",
                'fk_id_user_type' => "3",
            ],
            [
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => 'profe_852',
                'password' => bcrypt('pw0000'),
                'email' => "profe5Itt@ittol.com.mx",
                'fk_id_user_type' => "3",
            ],
            [
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => 'profe_963',
                'password' => bcrypt('pw0000'),
                'email' => "profe6Itt@ittol.com.mx",
                'fk_id_user_type' => "3",
            ],
            [
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => 'admin',
                'password' => bcrypt('pw0000'),
                'email' => "admin@ittol.com.mx",
                'fk_id_user_type' => "1",
            ],
        ]);


    }
}
