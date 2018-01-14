<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
			[
				'name' 		=> 'Gabriel',
				'last_name' => 'Rodriguez',
				'email' 	=> 'admin@hotmail.com',
				'user' 		=> 'admin87',
				'password' 	=> \Hash::make('password'),
				'type' 		=> 'admin',
				'active' 	=> 1,
				'address' 	=> 'Dirección',
				'created_at'=> new DateTime,
				'updated_at'=> new DateTime
			],
			[
				'name' 		=> 'Gerardo',
				'last_name' => 'Rodriguez',
				'email' 	=> 'user@hotmail.com',
				'user' 		=> 'user87',
				'password' 	=> \Hash::make('password'),
				'type' 		=> 'user',
				'active' 	=> 1,
				'address' 	=> 'Dirección',
				'created_at'=> new DateTime,
				'updated_at'=> new DateTime
			],

		);

		User::insert($data);
    }
}
