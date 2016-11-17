<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WatchlistTest extends TestCase
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
	
	
	public function test_watchlist_response()
	{
		$response = $this->call('GET', '/apiRequest');

		$this->assertEquals(500, $response->status());		 
	}
}