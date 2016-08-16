<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $gender
 * @property \Cake\I18n\Time $birth_date
 * @property int $cpf
 * @property int $rg
 * @property string $street
 * @property int $number
 * @property string $neighborhood
 * @property string $phone
 * @property string $cel_phone
 * @property int $city_id
 * @property int $state_id
 * @property string $profile
 * @property string $login
 * @property string $password
 *
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\State $state
 */
class User extends Entity
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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
