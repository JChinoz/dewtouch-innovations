<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TransactionItems Model
 *
 * @property \App\Model\Table\TransactionsTable&\Cake\ORM\Association\BelongsTo $Transactions
 * @property \App\Model\Table\TablesTable&\Cake\ORM\Association\BelongsTo $Tables
 *
 * @method \App\Model\Entity\TransactionItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\TransactionItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TransactionItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TransactionItem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TransactionItem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TransactionItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TransactionItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TransactionItem findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TransactionItemsTable extends Table
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

        $this->setTable('transaction_items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Transactions', [
            'foreignKey' => 'transaction_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Tables', [
            'foreignKey' => 'table_id'
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->decimal('quantity')
            ->allowEmptyString('quantity');

        $validator
            ->decimal('unit_price')
            ->allowEmptyString('unit_price');

        $validator
            ->scalar('uom')
            ->maxLength('uom', 255)
            ->allowEmptyString('uom');

        $validator
            ->decimal('sum')
            ->allowEmptyString('sum');

        $validator
            ->boolean('valid')
            ->notEmptyString('valid');

        $validator
            ->scalar('table')
            ->maxLength('table', 255)
            ->allowEmptyString('table');

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
        // $rules->add($rules->existsIn(['transaction_id'], 'Transactions'));
        $rules->add($rules->existsIn(['table_id'], 'Tables'));

        return $rules;
    }
}
