<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClientFilesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClientFilesTable Test Case
 */
class ClientFilesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClientFilesTable
     */
    public $ClientFiles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.client_files',
        'app.clients',
        'app.cities',
        'app.states',
        'app.drivers',
        'app.locations',
        'app.users',
        'app.reserves',
        'app.tickets',
        'app.vehicles',
        'app.types',
        'app.fuels',
        'app.rates',
        'app.rate_payments',
        'app.services',
        'app.files'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ClientFiles') ? [] : ['className' => 'App\Model\Table\ClientFilesTable'];
        $this->ClientFiles = TableRegistry::get('ClientFiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClientFiles);

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
