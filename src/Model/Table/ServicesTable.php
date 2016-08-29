<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Services Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Vehicles
 *
 * @method \App\Model\Entity\Service get($primaryKey, $options = [])
 * @method \App\Model\Entity\Service newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Service[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Service|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Service patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Service[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Service findOrCreate($search, callable $callback = null)
 */
class ServicesTable extends Table
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

        $this->table('services');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Vehicles', [
            'foreignKey' => 'vehicle_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
//    public function validationDefault(Validator $validator)
//    {
//        $validator
//            ->integer('id')
//            ->allowEmpty('id', 'create');
//
//        $validator
//            ->requirePresence('service_type', 'create')
//            ->notEmpty('service_type');
//
//        $validator
//            ->requirePresence('description', 'create');
//
//        $validator
//            ->requirePresence('make_km', 'create');
//
//        $validator
//            ->requirePresence('make_date', 'create')
//            ->notEmpty('make_date');
//
//        $validator
//            ->requirePresence('value', 'create')
//            ->notEmpty('value');
//
//        return $validator;
//    }

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
