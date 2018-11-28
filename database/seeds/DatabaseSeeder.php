<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alumno')->insert(
            [
                'nombre' => 'Alejandro',
                'apellidoP' => 'Gomez',
                'apellidoM' => 'Leiva',
                'correo' => 'alejandro@gmail.com',
                'usuario' => 'alu_14280487',
                'password' => bcrypt('pw0000'),
            ]
        );

        DB::table('revision_alumno')->insert(
            [
                'no_revision' => '1',
                'comentarios' => 'Esta es mi primer versión, saludos',
                'documento_url' => '/docx/students1/version_2_2018/11/28docx'
            ]
        );

        DB::table('proceso')->insert(
            [
                'opcion_tit' => 'Titulación',
                'estado' => 'Sin asignar',
                'created_at' => Carbon\Carbon::now()->subWeek(3),
                'updated_at' => Carbon\Carbon::now()->subWeek(3),
                'fk_id_alumno' => 1,
                'fk_id_revision_alumno' => 1
            ]
        );

        DB::table('profesor')->insert(
            [
                'nombre' => 'Navarro',
                'apellidoP' => 'Aguilar',
                'apellidoM' => 'Reyes',
                'correo' => 'navarro@gmail.com',
                'usuario' => 'profesor_123456',
                'password' => bcrypt('pw0000'),
            ]
        );
        DB::table('profesor')->insert(
            [
                'nombre' => 'Alejandra',
                'apellidoP' => 'Castillo',
                'apellidoM' => 'Reyes',
                'correo' => 'alejandrao@gmail.com',
                'usuario' => 'profesor_321654',
                'password' => bcrypt('pw0000'),
            ]
        );
        DB::table('profesor')->insert(
            [
                'nombre' => \Faker\Provider\Person::firstNameFemale(),
                'apellidoP' => 'Flores',
                'apellidoM' => 'Reyes',
                'correo' => 'alejandra@gmail.com',
                'usuario' => 'profesor_9632',
                'password' => bcrypt('pw0000'),
            ]
        );

    }
}
