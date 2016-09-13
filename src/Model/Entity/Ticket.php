<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ticket Entity
 *
 * @property int $id
 * @property int $vehicle_id
 * @property int $client_id
 * @property \Cake\I18n\Time $due_date
 * @property float $value
 * @property string $description
 * @property string $name_not_registered
 * @property string $rg_not_registered
 * @property string $cpf_not_registered
 *
 * @property \App\Model\Entity\Vehicle $vehicle
 * @property \App\Model\Entity\Client $client
 */
class Ticket extends Entity
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
