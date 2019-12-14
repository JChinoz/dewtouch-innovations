<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transaction Entity
 *
 * @property int $id
 * @property int $member_id
 * @property string|null $member_name
 * @property string|null $member_paytype
 * @property string|null $member_company
 * @property \Cake\I18n\FrozenDate|null $date
 * @property int|null $year
 * @property int|null $month
 * @property string|null $ref_no
 * @property string|null $receipt_no
 * @property string|null $payment_method
 * @property string|null $batch_no
 * @property string|null $cheque_no
 * @property string|null $payment_type
 * @property int|null $renewal_year
 * @property string|null $remarks
 * @property float|null $subtotal
 * @property float|null $tax
 * @property float|null $total
 * @property bool $valid
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Member $member
 * @property \App\Model\Entity\TransactionItem[] $transaction_items
 */
class Transaction extends Entity
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
        'member_id' => true,
        'member_name' => true,
        'member_paytype' => true,
        'member_company' => true,
        'date' => true,
        'year' => true,
        'month' => true,
        'ref_no' => true,
        'receipt_no' => true,
        'payment_method' => true,
        'batch_no' => true,
        'cheque_no' => true,
        'payment_type' => true,
        'renewal_year' => true,
        'remarks' => true,
        'subtotal' => true,
        'tax' => true,
        'total' => true,
        'valid' => true,
        'created' => true,
        'modified' => true,
        'member' => true,
        'transaction_items' => true
    ];
}
