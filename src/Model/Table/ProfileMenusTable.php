<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProfileMenus Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Profiles
 * @property \Cake\ORM\Association\BelongsTo $Menus
 *
 * @method \App\Model\Entity\ProfileMenu get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProfileMenu newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProfileMenu[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProfileMenu|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProfileMenu patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProfileMenu[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProfileMenu findOrCreate($search, callable $callback = null)
 */
class ProfileMenusTable extends Table
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

        $this->table('profile_menus');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Profiles', [
            'foreignKey' => 'profile_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Menus', [
            'foreignKey' => 'menu_id',
            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['profile_id'], 'Profiles'));
        $rules->add($rules->existsIn(['menu_id'], 'Menus'));

        return $rules;
    }
}
