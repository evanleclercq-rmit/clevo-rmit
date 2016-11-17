<?php
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Requests;
class apiRequestTest extends TestCase
{  
   
	
	public function test_api_response()
	{
		$response = $this->call('GET', '/apiRequest', $parameters = ["q" => "ASX.AX"]);

		$this->assertEquals(200, $response->status());	
	}
	
	
	
}