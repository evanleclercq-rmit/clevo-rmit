<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HistoryControllerTest extends TestCase
{
	
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed', ['--class' => 'DatabaseSeeder', '--database' => 'testing']);
    }    

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    public function test_database_was_seeded()
    {
        $this->assertCount(10, user::all());
    }

	
	
	public function test_get_history_page()
	{
		$user = factory(App\User::class)->create();

		$this->actingAs($user)
			 ->visit('/')
			 ->see('history');
	}
}