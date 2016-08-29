<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RatesFixture
 *
 */
class RatesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'vehicle_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'referent_year' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ipva_value' => ['type' => 'float', 'length' => 20, 'precision' => 5, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'ipva_expiration' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'depvat_value' => ['type' => 'float', 'length' => 20, 'precision' => 5, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'depvat_expiration' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'licensing_value' => ['type' => 'float', 'length' => 20, 'precision' => 5, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'licensing_expiration' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'vehicle_id_rates' => ['type' => 'index', 'columns' => ['vehicle_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'vehicle_id_rates' => ['type' => 'foreign', 'columns' => ['vehicle_id'], 'references' => ['vehicles', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'vehicle_id' => 1,
            'referent_year' => 1,
            'ipva_value' => 1,
            'ipva_expiration' => '2016-08-27',
            'depvat_value' => 1,
            'depvat_expiration' => '2016-08-27',
            'licensing_value' => 1,
            'licensing_expiration' => '2016-08-27'
        ],
    ];
}
