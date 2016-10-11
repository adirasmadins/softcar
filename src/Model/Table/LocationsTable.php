<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Locations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Clients
 * @property \Cake\ORM\Association\BelongsTo $Vehicles
 * @property \Cake\ORM\Association\BelongsTo $Drivers
 *
 * @method \App\Model\Entity\Location get($primaryKey, $options = [])
 * @method \App\Model\Entity\Location newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Location[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Location|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Location patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Location[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Location findOrCreate($search, callable $callback = null)
 */
class LocationsTable extends Table
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

        $this->table('locations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Vehicles', [
            'foreignKey' => 'vehicle_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Drivers', [
            'foreignKey' => 'driver_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
//            ->numeric('start_value')
            ->requirePresence('start_value', 'create')
            ->notEmpty('start_value');

        $validator
            ->numeric('total')
            ->allowEmpty('total');

        $validator
            ->allowEmpty('form_payment');

        $validator
//            ->date('out_date')
            ->allowEmpty('out_date');

        $validator
//            ->date('return_date')
            ->allowEmpty('return_date');

        $validator
//            ->numeric('start_km')
            ->requirePresence('start_km', 'create')
            ->notEmpty('start_km');

        $validator
            ->integer('free_km')
            ->requirePresence('free_km', 'create')
            ->notEmpty('free_km');

        $validator
            ->numeric('allowed_km')
            ->requirePresence('allowed_km', 'create')
            ->notEmpty('allowed_km');

        $validator
            ->requirePresence('tank_check', 'create')
            ->notEmpty('tank_check');

        $validator
//            ->date('location_date')
            ->requirePresence('location_date', 'create')
            ->notEmpty('location_date');

        $validator
            ->date('payment_date')
            ->allowEmpty('payment_date');

        return $validator;
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
        $rules->add($rules->existsIn(['client_id'], 'Clients'));
        $rules->add($rules->existsIn(['vehicle_id'], 'Vehicles'));
        $rules->add($rules->existsIn(['driver_id'], 'Drivers'));

        return $rules;
    }
}
