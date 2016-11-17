<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DashboardControllerTest extends TestCase
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

	
	public function test_get_dashboard_page_response()
	{
		$user = factory(User::class)->create();

		$this->actingAs($user)
				->visit('/dashboard')
				->see('company');
	}

	public function test_view_has_companies_data()
	{
		$this->withoutMiddleware();

		$res = $this->call('GET', '/dashboard');
	}

}
