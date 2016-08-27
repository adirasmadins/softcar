<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rate Entity
 *
 * @property int $id
 * @property int $vehicle_id
 * @property int $referent_year
 * @property float $ipva_value
 * @property \Cake\I18n\Time $ipva_expiration
 * @property float $depvat_value
 * @property \Cake\I18n\Time $depvat_expiration
 * @property float $licensing_value
 * @property \Cake\I18n\Time $licensing_expiration
 *
 * @property \App\Model\Entity\Vehicle $vehicle
 * @property \App\Model\Entity\RatePayment[] $rate_payments
 */
class Rate extends Entity
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
