<?php


use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class AccountsTest extends TestCase
{
    /**
     * Tests User Account functionality
     *
     * @return void
     */

    // Reverses any changes to DB between tests
    use DatabaseTransactions; 

 
    public function testLinksExist()
    {
        $this->visit('/')
             ->see('LOGIN');
        $this->visit('/')
             ->see('REGISTER');
    }

    public function testLoginURL(){
        $response = $this->call('GET', '/login');
        $this->assertEquals(200, $response->status());
    }

    public function testRegisterURL(){
        $response = $this->call('GET', '/register');
        $this->assertEquals(200, $response->status());
    }

    public function testRegisterPasswordMismatch()
    {
        $this->visit('/')
        ->see('Register')
        ->click('Register')
        ->seePageIs('/register')
        ->submitForm('Register', ['name' => 'testuser', 'email' => 'testuser@unittest.com', 'password' => 'password', 'password_confirmation' => 'wordpass'])
        ->see('The password confirmation does not match.');
    }

    public function testRegisterationSuccess()
    {
        $this->visit('/')
        ->see('Register')
        ->click('Register')
        ->seePageIs('/register')
        ->submitForm('Register', ['name' => 'testuser', 'email' => 'testuser2@clevo.com', 'password' => 'password', 'password_confirmation' => 'password'])
        ->seePageIs('/dashboard')
        ->seeInDatabase('users', ['email' => 'testuser2@clevo.com']);
    }

    public function testLoginInvalidEmail()
    {
        $this->visit('/')
        ->see('Login')
        ->click('Login')
        ->seePageIs('/login')
        ->submitForm('Login', ['email' => 'testuser', 'password' => 'password'])
        ->see('form-group has-error');
    }

    public function testLoginSuccess()
    {
        $this->visit('/')
        ->see('Login')
        ->click('Login')
        ->seePageIs('/login')
        ->submitForm('Login', ['email' => 'testuser@clevo.com', 'password' => 'password'])
        ->seePageIs('/dashboard');
    }
}
