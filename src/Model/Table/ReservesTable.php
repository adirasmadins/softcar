<?php
namespace App\Model\Table;

use Cake\Network\Session\DatabaseSession;
use Cake\ORM\Query;
use Cake\Datasource\ConnectionManager;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Core\Configure;
use Cake\Validation\Validator;

/**
 * Reserves Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Clients
 * @property \Cake\ORM\Association\BelongsTo $Vehicles
 *
 * @method \App\Model\Entity\Reserve get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reserve newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Reserve[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reserve|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reserve patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reserve[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reserve findOrCreate($search, callable $callback = null)
 */
class ReservesTable extends Table
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

        $this->table('reserves');
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
            //->date('date_start')
            ->requirePresence('date_start', 'create')
            ->notEmpty('date_start');

        $validator
            //->date('date_end')
            ->requirePresence('date_end', 'create')
            ->notEmpty('date_end');

        $validator
            ->time('remove_schedule')
            ->requirePresence('remove_schedule', 'create')
            ->notEmpty('remove_schedule');

        $validator
            ->time('devolution_schedule')
            ->requirePresence('devolution_schedule', 'create')
            ->notEmpty('devolution_schedule');

        $validator
            //->date('reserve_date')
            ->requirePresence('reserve_date', 'create')
            ->notEmpty('reserve_date');

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

        return $rules;
    }

    public function queryVerify($date_start, $date_end, $idVehicleAllow){
        $search = [
            '%DATE_START%',
            '%DATE_END%',
            '%VEHICLE_ALLOW%'
        ];
        $replace = [
            $date_start,
            $date_end,
            $idVehicleAllow
        ];

        $query = str_replace($search, $replace, Configure::read('Queries.Reserves'));

        $default = 'default';
        $informations = ConnectionManager::get($default);
        $database = $informations->config();

        $db = new \mysqli($database['host'], $database['username'], $database['password'], $database['database']);
        $result = $db->query($query)->fetch_all();

        return $result;
    }
}
