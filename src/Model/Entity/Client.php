<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Client Entity
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $cel_phone
 * @property string $rg_ie
 * @property float $cpf_cnpj
 * @property string $gender
 * @property \Cake\I18n\Time $birth_date
 * @property string $street
 * @property int $number
 * @property int $city_id
 * @property int $state_id
 * @property string $cep
 * @property int $cnh
 * @property \Cake\I18n\Time $validity_cnh
 * @property \Cake\I18n\Time $first_license
 *
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Location[] $locations
 * @property \App\Model\Entity\Reserve[] $reserves
 * @property \App\Model\Entity\Ticket[] $tickets
 */
class Client extends Entity
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
