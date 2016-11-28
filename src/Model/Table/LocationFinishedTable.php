<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LocationFinished Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Locations
 *
 * @method \App\Model\Entity\LocationFinished get($primaryKey, $options = [])
 * @method \App\Model\Entity\LocationFinished newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LocationFinished[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LocationFinished|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LocationFinished patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LocationFinished[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LocationFinished findOrCreate($search, callable $callback = null)
 */
class LocationFinishedTable extends Table
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

        $this->table('location_finished');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id'
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
            // ->numeric('finish_value')
            ->allowEmpty('finish_value');

        $validator
            // ->numeric('finish_km')
            ->allowEmpty('finish_km');

        $validator
            ->allowEmpty('finish_tank');

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
        $rules->add($rules->existsIn(['location_id'], 'Locations'));

        return $rules;
    }
}
