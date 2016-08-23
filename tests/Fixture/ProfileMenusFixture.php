<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProfileMenusFixture
 *
 */
class ProfileMenusFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'profile_menus';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'profile_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'menu_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'profile_id_profiles' => ['type' => 'index', 'columns' => ['profile_id'], 'length' => []],
            'menu_id_menus' => ['type' => 'index', 'columns' => ['menu_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'menu_id_menus' => ['type' => 'foreign', 'columns' => ['menu_id'], 'references' => ['menus', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'profile_id_profiles' => ['type' => 'foreign', 'columns' => ['profile_id'], 'references' => ['profiles', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'profile_id' => 1,
            'menu_id' => 1
        ],
    ];
}
