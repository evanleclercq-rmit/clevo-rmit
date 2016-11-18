<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $user = ['name' => 'admin','email' => 'admin@clevo.com','password' => bcrypt('Pass1234!'), 'admin' => true, 'balance' => '1'];
        DB::table('users')->insert($user);
    }
}
