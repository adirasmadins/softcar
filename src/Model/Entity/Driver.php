<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Driver Entity
 *
 * @property int $id
 * @property string $name
 * @property string $rg
 * @property string $cpf
 * @property string $gender
 * @property \Cake\I18n\Time $birth_date
 * @property string $phone
 * @property string $cel_phone
 * @property int $city_id
 * @property int $state_id
 * @property string $cep
 * @property int $cnh
 * @property \Cake\I18n\Time $first_license
 * @property \Cake\I18n\Time $validity_cnh
 *
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Location[] $locations
 */
class Driver extends Entity
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
