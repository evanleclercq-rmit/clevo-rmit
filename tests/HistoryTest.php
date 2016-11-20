<?php

use App\Transaction;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;


class HistoryTest extends TestCase
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

    public function test_i_can_see_empty_history()
    {
        $this->be(User::first());

        $this->visit('history');
        $this->see('Transaction History');
        $this->see('Units Traded');
        $this->see('Company');
        $this->see('Type');
        $this->see('Date');
        $this->see('Price Per Unit');
        $this->see('Total Price');
    }

    public function test_see_transactions()
    {
        $user = User::first();
        $this->be($user);
        $company = \App\Companies::first();
        $date = new DateTimeImmutable('now');
        Transaction::create([
            'name' => $user->name,
            'number' => 1,
            'price' => 1,
            'total' => 1,
            'date' => $date->format('d/m/Y'),
            'symbol' => $company->symbol,
            'type' => 'Purchase',
        ]);

        Transaction::create([
            'name' => $user->name,
            'number' => 1,
            'price' => 1,
            'total' => 1,
            'date' => '10/04/2016',
            'symbol' => $company->symbol,
            'type' => 'Purchase',
        ]);

        
        $this->assertCount(2, Transaction::all());

        $this->visit('history');
        $this->see($date->format('d/m/Y')); 
        $this->see('10/04/2016'); 
    }
}

