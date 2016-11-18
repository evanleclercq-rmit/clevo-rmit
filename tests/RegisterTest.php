<?php


use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;


class RegisterTest extends TestCase
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

    public function test_database_was_seeded()
    {
        $this->assertCount(10, user::all());
    }

    public function test_user_auth()
    {
        $user = User::first();
        $this->be($user);
    }

    public function test_auth_redirect()
    {
        $user = User::first();

        $this->actingAs($user)
             ->get('/dashboard')
             ->assertResponseStatus(200);
    }

    public function test_redirect_to_login_if_guest()
    {
        $this->assertTrue(Auth::guest());
        $this->call('GET', '/dashboard');
        $this->assertRedirectedTo('/login');
    }

    public function testNewUserRegistration()
    {
        $this->visit('/register')
            ->type('clevo', 'name')
            ->type('clevo@gmail.com', 'email')
			->type('Melbourne', 'city')
			->type('99', 'age')
            ->type('password1*', 'password')
            ->type('password1*', 'password_confirmation')
            ->press('Register')
            ->see('Leaderboard');
    }
}
