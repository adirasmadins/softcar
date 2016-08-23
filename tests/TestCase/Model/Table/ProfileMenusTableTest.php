<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProfileMenusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProfileMenusTable Test Case
 */
class ProfileMenusTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProfileMenusTable
     */
    public $ProfileMenus;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.profile_menus',
        'app.profiles',
        'app.users',
        'app.cities',
        'app.states',
        'app.clients',
        'app.drivers',
        'app.menus'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProfileMenus') ? [] : ['className' => 'App\Model\Table\ProfileMenusTable'];
        $this->ProfileMenus = TableRegistry::get('ProfileMenus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProfileMenus);

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
