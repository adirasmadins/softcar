<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Service Entity
 *
 * @property int $id
 * @property int $vehicle_id
 * @property string $service_type
 * @property string $description
 * @property float $make_km
 * @property \Cake\I18n\Time $make_date
 * @property float $value
 *
 * @property \App\Model\Entity\Vehicle $vehicle
 */
class Service extends Entity
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
