<?php

use App\User;

class LogoutTest extends TestCase
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

   public function test_can_logout()
    {
        $this->be(User::first());
        $this->visit('dashboard');
        $this->call('POST', 'logout');
        $this->followRedirects();

        $this->seePageIs('login');
    }

    public function test_logging_out()
    {
        $this->be(User::first());
        $this->visit('dashboard');
        $this->call('POST', 'logout');
        $this->visit('dashboard');

        $this->seePageIs('login');
    }
}