<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class apiRequestTest extends TestCase
{
	public function test_api_response()
	{
		$response = $this->call('GET', '/apiRequest', $parameters = ["q" => "ASX.AX"]);

		$this->assertEquals(500, $response->status());	
	}
}