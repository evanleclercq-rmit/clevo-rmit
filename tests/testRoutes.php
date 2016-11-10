
<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class AllRoutesTest extends TestCase
{
   
    
    public function setUp()
    {
        parent::setUp();
       
        

    }

    /**
     * test all route
     *
     * @group route
     */

    public function testAllRoute()
    {
        $routeCollection = Route::getRoutes();
        $this->withoutEvents();
        $blacklist = [
            'url/that/not/tested',
        ];
        $dynamicReg = "/{\\S*}/"; 
        
        foreach ($routeCollection as $route) {
            if (!preg_match($dynamicReg, $route->getUri()) &&
                in_array('GET', $route->getMethods()) && 
                !in_array($route->getUri(), $blacklist)
            ) {
                $start = $this->microtimeFloat();
                fwrite(STDERR, print_r('test ' . $route->getUri() . "\n", true));
                $end   = $this->microtimeFloat();
                $temps = round($end - $start, 3);
                fwrite(STDERR, print_r('time: ' . $temps . "\n", true));
                $this->assertLessThan(5, $temps, "too long time for " . $route->getUri());
               

            }

        }
    }

    public function microtimeFloat()
    {
        list($usec, $asec) = explode(" ", microtime());

        return ((float) $usec + (float) $asec);

    }
}