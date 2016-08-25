<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vehicle Entity
 *
 * @property int $id
 * @property string $plate
 * @property string $chassi
 * @property float $renavam
 * @property int $type_id
 * @property int $fuel_id
 * @property string $mark
 * @property string $model
 * @property int $date_fabrication
 * @property int $date_model
 * @property string $color
 * @property float $day_price
 *
 * @property \App\Model\Entity\Type $type
 * @property \App\Model\Entity\Fuel $fuel
 * @property \App\Model\Entity\Location[] $locations
 * @property \App\Model\Entity\Rate[] $rates
 * @property \App\Model\Entity\Reserve[] $reserves
 * @property \App\Model\Entity\Service[] $services
 * @property \App\Model\Entity\Ticket[] $tickets
 */
class Vehicle extends Entity
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
