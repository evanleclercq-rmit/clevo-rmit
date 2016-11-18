<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HistoryControllerTest extends TestCase
{
    public $user;
	
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed', ['--class' => 'DatabaseSeeder', '--database' => 'testing']);

        $this->user = factory(App\User::class)->create();
    }    

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    public function test_database_was_seeded()
    {
        $this->assertCount(11, user::all());
    }
	
	public function test_get_history_page()
	{
		$this->actingAs($this->user)
			 ->visit('/history')
			 ->see('Transaction History');
	}

    public function test_history_view_has_data()
    {
        $this->actingAs($this->user)
             ->get('/history')
             ->assertViewHas('history');
    }

    public function test_all_history_view_with_unregistered_user()
    {
        $response = $this->call('GET', '/history');

        $this->assertEquals(302, $response->status());
    }
    
    public function test_all_history_view_with_registered_user()
    {
        $this->actingAs($this->user)->call('GET', '/history');

        $this->assertResponseOk();
    }

}