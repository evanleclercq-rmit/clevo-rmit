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
        foreach (range(1,9) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'city' => $faker->city,
                'email' => $faker->email,
                'age' => $faker->numberBetween($min = 18, $max = 99),
                'password' => bcrypt('secret'),
                'balance' => $faker->numberBetween($min = 5000, $max = 22000),
            ]);
        }
    }
}