<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TransactionItem[]|\Cake\Collection\CollectionInterface $transactionItems
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Transaction Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Transactions'), ['controller' => 'Transactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Transaction'), ['controller' => 'Transactions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="transactionItems index large-9 medium-8 columns content">
    <h3><?= __('Transaction Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('unit_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('uom') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sum') ?></th>
                <th scope="col"><?= $this->Paginator->sort('valid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('table') ?></th>
                <th scope="col"><?= $this->Paginator->sort('table_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactionItems as $transactionItem): ?>
            <tr>
                <td><?= $this->Number->format($transactionItem->id) ?></td>
                <td><?= $transactionItem->has('transaction') ? $this->Html->link($transactionItem->transaction->id, ['controller' => 'Transactions', 'action' => 'view', $transactionItem->transaction->id]) : '' ?></td>
                <td><?= $this->Number->format($transactionItem->quantity) ?></td>
                <td><?= $this->Number->format($transactionItem->unit_price) ?></td>
                <td><?= h($transactionItem->uom) ?></td>
                <td><?= $this->Number->format($transactionItem->sum) ?></td>
                <td><?= h($transactionItem->valid) ?></td>
                <td><?= h($transactionItem->created) ?></td>
                <td><?= h($transactionItem->modified) ?></td>
                <td><?= h($transactionItem->table) ?></td>
                <td><?= $this->Number->format($transactionItem->table_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $transactionItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $transactionItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $transactionItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transactionItem->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
