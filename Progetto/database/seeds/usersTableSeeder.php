<?php

use Illuminate\Database\Seeder;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Users')->insert([
            'name'      => 'Admin',
            'surname'   => ' ',
            'email'     => 'adminAppWeb@gmail.com',
            'password'  => bcrypt('admin101'),
            'role'      => '1',
            'updated_at'    => date('Y-m-d h:i:s'),
            'created_at'    => date('Y-m-d h:i:s')		        		        
        ]);
    }
}
