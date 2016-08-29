<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rates Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Vehicles
 * @property \Cake\ORM\Association\HasMany $RatePayments
 *
 * @method \App\Model\Entity\Rate get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rate newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Rate[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rate|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rate patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rate[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rate findOrCreate($search, callable $callback = null)
 */
class RatesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('rates');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Vehicles', [
            'foreignKey' => 'vehicle_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('RatePayments', [
            'foreignKey' => 'rate_id'
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['vehicle_id'], 'Vehicles'));

        return $rules;
    }
}
