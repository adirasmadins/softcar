<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ReservesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ReservesController Test Case
 */
class ReservesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.reserves',
        'app.clients',
        'app.cities',
        'app.states',
        'app.drivers',
        'app.locations',
        'app.users',
        'app.tickets',
        'app.vehicles',
        'app.types',
        'app.fuels',
        'app.rates',
        'app.rate_payments',
        'app.services'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
