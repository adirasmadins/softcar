<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vehicles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Types
 * @property \Cake\ORM\Association\BelongsTo $Fuels
 * @property \Cake\ORM\Association\HasMany $Locations
 * @property \Cake\ORM\Association\HasMany $Rates
 * @property \Cake\ORM\Association\HasMany $Reserves
 * @property \Cake\ORM\Association\HasMany $Services
 * @property \Cake\ORM\Association\HasMany $Tickets
 *
 * @method \App\Model\Entity\Vehicle get($primaryKey, $options = [])
 * @method \App\Model\Entity\Vehicle newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Vehicle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Vehicle|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vehicle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Vehicle[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Vehicle findOrCreate($search, callable $callback = null)
 */
class VehiclesTable extends Table
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

        $this->table('vehicles');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Types', [
            'foreignKey' => 'type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Fuels', [
            'foreignKey' => 'fuel_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Locations', [
            'foreignKey' => 'vehicle_id'
        ]);
        $this->hasMany('Rates', [
            'foreignKey' => 'vehicle_id'
        ]);
        $this->hasMany('Reserves', [
            'foreignKey' => 'vehicle_id'
        ]);
        $this->hasMany('Services', [
            'foreignKey' => 'vehicle_id'
        ]);
        $this->hasMany('Tickets', [
            'foreignKey' => 'vehicle_id'
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
            ->requirePresence('plate', 'create')
            ->notEmpty('plate');

        $validator
            ->requirePresence('chassi', 'create')
            ->notEmpty('chassi');

        $validator
            ->numeric('renavam')
            ->requirePresence('renavam', 'create')
            ->notEmpty('renavam');

        $validator
            ->requirePresence('mark', 'create')
            ->notEmpty('mark');

        $validator
            ->requirePresence('model', 'create')
            ->notEmpty('model');

        $validator
            ->integer('date_fabrication')
            ->requirePresence('date_fabrication', 'create')
            ->notEmpty('date_fabrication');

        $validator
            ->integer('date_model')
            ->requirePresence('date_model', 'create')
            ->notEmpty('date_model');

        $validator
            ->requirePresence('color', 'create')
            ->notEmpty('color');

        $validator
            ->requirePresence('day_price', 'create')
            ->notEmpty('day_price');

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
        $rules->add($rules->existsIn(['type_id'], 'Types'));
        $rules->add($rules->existsIn(['fuel_id'], 'Fuels'));

        return $rules;
    }
}
