<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContractTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContractTable Test Case
 */
class ContractTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContractTable
     */
    public $Contract;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contract'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Contract') ? [] : ['className' => 'App\Model\Table\ContractTable'];
        $this->Contract = TableRegistry::get('Contract', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Contract);

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
}
