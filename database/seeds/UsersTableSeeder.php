<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'user1',
            'email' => 'test@test.com',
            'role' => '',
            'password' => bcrypt('test'),
        ]);
    }
}
