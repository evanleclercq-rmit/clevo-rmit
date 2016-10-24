<?php 

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use database\seeds\ContactsTableSeeder;
use Faker\Factory as Faker;
use App\Models\User;



class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    	foreach (range(1,10) as $index) {
	        DB::table('users')->insert([
	            'name' => $faker->name,
	            'email' => $faker->email,
	            'password' => bcrypt('secret'),
                'balance' => '1000000',
	        ]);
        }
    }
}