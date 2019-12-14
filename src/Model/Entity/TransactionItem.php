<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TransactionItem Entity
 *
 * @property int $id
 * @property int $transaction_id
 * @property string|null $description
 * @property float|null $quantity
 * @property float|null $unit_price
 * @property string|null $uom
 * @property float|null $sum
 * @property bool $valid
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $table_id
 *
 * @property \App\Model\Entity\Table $table
 * @property \App\Model\Entity\Transaction $transaction
 */
class TransactionItem extends Entity
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
        'transaction_id' => true,
        'description' => true,
        'quantity' => true,
        'unit_price' => true,
        'uom' => true,
        'sum' => true,
        'valid' => true,
        'created' => true,
        'modified' => true,
        'table' => true,
        'table_id' => true,
        'transaction' => true
    ];
}
