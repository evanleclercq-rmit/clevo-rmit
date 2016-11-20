<?php


use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;


class AccountsTest extends TestCase
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
        $this->assertCount(10, User::all());
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

    public function test_forgot_password()
    {
        Mail::shouldReceive('send')->once();

        $userWhoForgotThePassword = User::first();

        $this->visit('/password/reset');
        $this->submitForm('Send Password Reset Link', [
            'email' => $userWhoForgotThePassword->email
        ]);
    }

    public function test_cannot_send_reset_email_to_invalid_address()
    {
        Mail::shouldReceive('send')->never();

        $this->visit('/password/reset');
        $this->submitForm('Send Password Reset Link', [
            'email' => 'fake'
        ]);

        $this->see('The email must be a valid email address.');
    }

    
    public function test_can_create_user()
    {
        $this->visit('/register');

        $this->submitForm('Register', [
                'name' => 'Clevo',
                'email' => 'clevo@gmail.com',
                'city' => 'Melbourne',
                'age' => '45',
                'password' => 'Password1#',
                'password_confirmation' => 'Password1#'
            ]);

        $this->seePageIs('/dashboard');
        
    }

    
    public function test_fields_are_validated()
    {
        
        $this->visit('/register');
        $this->submitForm('Register', [
            'name' => 'Clevo',
            'email' => 'clevo@gmail.com',
            'city' => 'Melbourne',
            'age' => '11',
            'password' => 'Password1#',
            'password_confirmation' => 'Password1#'
        ]);

        $this->see('You must be at least 18 years old to create an account');
        
        $this->assertTrue(Auth::guest());

        

        $this->visit('/register');
        $this->submitForm('Register', [
            'name' => 'Clevo',
            'email' => 'invalid email address',
            'city' => 'Melbourne',
            'age' => '30',
            'password' => 'Password1#',
            'password_confirmation' => 'Password1#'
        ]);

        $this->see('The email must be a valid email address.');
        $this->assertTrue(Auth::guest());

        

        
       

     
        
    }
}
