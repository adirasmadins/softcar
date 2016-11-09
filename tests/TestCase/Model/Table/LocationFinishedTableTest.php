<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LocationFinishedTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LocationFinishedTable Test Case
 */
class LocationFinishedTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LocationFinishedTable
     */
    public $LocationFinished;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.location_finished',
        'app.locations',
        'app.clients',
        'app.cities',
        'app.states',
        'app.drivers',
        'app.users',
        'app.reserves',
        'app.vehicles',
        'app.types',
        'app.fuels',
        'app.rates',
        'app.rate_payments',
        'app.services',
        'app.tickets',
        'app.files',
        'app.client_files'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('LocationFinished') ? [] : ['className' => 'App\Model\Table\LocationFinishedTable'];
        $this->LocationFinished = TableRegistry::get('LocationFinished', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LocationFinished);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
