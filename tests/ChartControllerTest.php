<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ChartControllerTest extends TestCase
{

	public function test_chart_view()
	{
		$response = $this->call('GET', '/chart',  [
		    '_token' => Session::token(),            
		]);

		$this->assertEquals(500, $response->status());		 
	}
}