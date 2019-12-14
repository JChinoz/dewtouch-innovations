<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Transactions Model
 *
 * @property \App\Model\Table\MembersTable&\Cake\ORM\Association\BelongsTo $Members
 * @property \App\Model\Table\TransactionItemsTable&\Cake\ORM\Association\HasMany $TransactionItems
 *
 * @method \App\Model\Entity\Transaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\Transaction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Transaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Transaction|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Transaction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Transaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Transaction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Transaction findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TransactionsTable extends Table
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

        $this->setTable('transactions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Members', [
            'foreignKey' => 'member_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('TransactionItems', [
            'foreignKey' => 'transaction_id'
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
            ->scalar('member_name')
            ->maxLength('member_name', 255)
            ->allowEmptyString('member_name');

        $validator
            ->scalar('member_paytype')
            ->maxLength('member_paytype', 11)
            ->allowEmptyString('member_paytype');

        $validator
            ->scalar('member_company')
            ->maxLength('member_company', 255)
            ->allowEmptyString('member_company');

        $validator
            ->date('date')
            ->allowEmptyDate('date');

        $validator
            ->integer('year')
            ->allowEmptyString('year');

        $validator
            ->integer('month')
            ->allowEmptyString('month');

        $validator
            ->scalar('ref_no')
            ->maxLength('ref_no', 255)
            ->allowEmptyString('ref_no');

        $validator
            ->scalar('receipt_no')
            ->maxLength('receipt_no', 255)
            ->allowEmptyString('receipt_no');

        $validator
            ->scalar('payment_method')
            ->maxLength('payment_method', 255)
            ->allowEmptyString('payment_method');

        $validator
            ->scalar('batch_no')
            ->maxLength('batch_no', 255)
            ->allowEmptyString('batch_no');

        $validator
            ->scalar('cheque_no')
            ->maxLength('cheque_no', 255)
            ->allowEmptyString('cheque_no');

        $validator
            ->scalar('payment_type')
            ->maxLength('payment_type', 255)
            ->allowEmptyString('payment_type');

        $validator
            ->integer('renewal_year')
            ->allowEmptyString('renewal_year');

        $validator
            ->scalar('remarks')
            ->maxLength('remarks', 255)
            ->allowEmptyString('remarks');

        $validator
            ->decimal('subtotal')
            ->allowEmptyString('subtotal');

        $validator
            ->decimal('tax')
            ->allowEmptyString('tax');

        $validator
            ->decimal('total')
            ->allowEmptyString('total');

        $validator
            ->boolean('valid')
            ->notEmptyString('valid');

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
        $rules->add($rules->existsIn(['member_id'], 'Members'));

        return $rules;
    }
}
