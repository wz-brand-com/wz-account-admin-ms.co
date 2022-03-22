<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
		// DB::table('users')->insert([
		// 	'role_id' => '1',
		// 	'email' => 'admin@blog.com',
		// 	'password' => bcrypt('rootadmin'),
		// ]);
		// DB::table('users')->insert([
		// 	'role_id' => '2',
		// 	'email' => 'manager@blog.com',
		// 	'password' => bcrypt('rootmanager'),
		// ]);

		// DB::table('users')->insert([
		// 	'role_id' => '3',
		// 	'email' => 'user@blog.com',
		// 	'password' => bcrypt('rootuser'),
		// ]);
	}
}
