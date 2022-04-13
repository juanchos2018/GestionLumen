<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rols')->insert([          
            'nombre_rol' => 'Jefe de Proyecto',           
        ]);
        DB::table('rols')->insert([          
            'nombre_rol' => 'Analista de Sistemas',           
        ]);
        DB::table('rols')->insert([          
            'nombre_rol' => 'Programador',           
        ]);
        DB::table('rols')->insert([          
            'nombre_rol' => 'Diseñador',           
        ]);
        DB::table('tipo_usuarios')->insert([          
            'nombre_tipo' => 'Administrador', //1         
        ]);
        DB::table('tipo_usuarios')->insert([          
            'nombre_tipo' => 'Jefe',         //2  
        ]);
        DB::table('tipo_usuarios')->insert([          
            'nombre_tipo' => 'Miembro',       //3   
        ]);

        DB::table('usuarios')->insert([          
            'nombre_usuario' => 'pedro',  
            'apellido_usuario' => 'pedro',  
            'correo_usuario' => 'pedro@gmail.com',   
            'password_usuario' => '123456',       
            'id_tipo'=>2   
        ]);
        DB::table('usuarios')->insert([          
            'nombre_usuario' => 'mienbro1',  
            'apellido_usuario' => 'mienbro1',  
            'correo_usuario' => 'mienbro1@gmail.com',   
            'password_usuario' => '123456',       
            'id_tipo'=>3   
        ]);
        DB::table('usuarios')->insert([          
            'nombre_usuario' => 'mienbro2',  
            'apellido_usuario' => 'mienbro2',  
            'correo_usuario' => 'mienbro2@gmail.com',   
            'password_usuario' => '123456',       
            'id_tipo'=>3   
        ]);

        DB::table('elementos')->insert([   
            'nombre_elemento' => 'Elemento 1'             
        ]);
        DB::table('elementos')->insert([   
            'nombre_elemento' => 'Elemento 2'             
        ]);
        DB::table('elementos')->insert([   
            'nombre_elemento' => 'Elemento 3'             
        ]);
        DB::table('elementos')->insert([   
            'nombre_elemento' => 'Elemento 4'             
        ]);
        DB::table('elementos')->insert([   
            'nombre_elemento' => 'Elemento 5'             
        ]);
        DB::table('elementos')->insert([   
            'nombre_elemento' => 'Elemento 6'             
        ]);
        DB::table('elementos')->insert([   
            'nombre_elemento' => 'Elemento 7'             
        ]);
        DB::table('elementos')->insert([   
            'nombre_elemento' => 'Elemento 8'             
        ]);
        DB::table('elementos')->insert([   
            'nombre_elemento' => 'Elemento 9'             
        ]);
        DB::table('elementos')->insert([   
            'nombre_elemento' => 'Elemento 10'             
        ]);
        DB::table('elementos')->insert([   
            'nombre_elemento' => 'Elemento 11'             
        ]);
        DB::table('elementos')->insert([   
            'nombre_elemento' => 'Elemento 12'             
        ]);
        DB::table('elementos')->insert([   
            'nombre_elemento' => 'Elemento 13'             
        ]);
        DB::table('elementos')->insert([   
            'nombre_elemento' => 'Elemento 14'             
        ]);


        DB::table('metodologias')->insert([   
            'nombre' => 'Metodologia 1'             
        ]);
        DB::table('metodologias')->insert([   
            'nombre' => 'Metodologia 2'             
        ]);
     
    }
}
