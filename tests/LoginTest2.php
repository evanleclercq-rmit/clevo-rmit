<?php


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;


class LoginTest2 extends TestCase
{
	use DatabaseMigrations;
	
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
    public function test_page_is_login()
	{
		$this->visit('/login')
		->see('Getting Started');
		
	}
	public function testURL()
	{
		$response=$this->call('Get','/login');
		$this->assertEquals(200,$response->status());
	}
	
	public function test_link_functions()
	{
	    $this->visit('/')
        ->click('Register')
        ->see('/register');		
	}
	
   public function testwrongValues()
   {
	   $this->visit('/login')->click('Login')->seePageIs('/login');
   }
  
  public function testMisMatchdata()
   {
	   $user =User::first();
	   $this->visit('/login')
	   ->type($user->email,'email')
	   ->type('ddt','password')
	   ->click('Login')
	   ->seePageIs('/login');
   }
  
  
    
   public function testCorrectData(){
	   $user= User::first();
	   
	   $this->visit('/login')
	   ->type($user->email,'email')
	   ->type($user->password, 'password')
	   ->press('Login')
	   ->see('These credentials do not match our records.');
   }
	
	   
}  


	

    
	
	
	
	
	
	
	
