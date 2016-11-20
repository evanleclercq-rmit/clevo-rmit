<?php

use App\Transaction;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;


class DashboardTest extends TestCase
{
    /**
     * Tests User Account functionality
     *
     * @return void
     */

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


    public function test_guest_cannot_access_dashboard()
    {
        $this->visit('dashboard');
        $this->seePageIs('login');
    }

    public function test_see_current_hodlings()
    {
        $user = User::first();
        $this->be($user);

       
        $user->balance = 110;
        $user->save();

        
        $this->visit('dashboard');
        $this->see('Initial Cash Balance'); 
        $this->see('$20000.00'); 
        $this->see('$110.00'); 
    }
}

