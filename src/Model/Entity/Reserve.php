<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Reserve Entity
 *
 * @property int $id
 * @property int $client_id
 * @property int $vehicle_id
 * @property \Cake\I18n\Time $date_start
 * @property \Cake\I18n\Time $date_end
 * @property \Cake\I18n\Time $remove_schedule
 * @property \Cake\I18n\Time $devolution_schedule
 * @property \Cake\I18n\Time $reserve_date
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Vehicle $vehicle
 */
class Reserve extends Entity
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
