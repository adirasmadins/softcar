<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Location Entity
 *
 * @property int $id
 * @property int $client_id
 * @property int $vehicle_id
 * @property int $driver_id
 * @property string $status
 * @property float $start_value
 * @property float $total
 * @property string $form_payment
 * @property \Cake\I18n\Time $out_date
 * @property \Cake\I18n\Time $return_date
 * @property float $start_km
 * @property int $free_km
 * @property float $allowed_km
 * @property string $tank_check
 * @property \Cake\I18n\Time $location_date
 * @property \Cake\I18n\Time $payment_date
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Vehicle $vehicle
 * @property \App\Model\Entity\Driver $driver
 */
class Location extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
