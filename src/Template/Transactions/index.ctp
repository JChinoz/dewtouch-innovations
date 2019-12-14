<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transaction[]|\Cake\Collection\CollectionInterface $transactions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Transaction'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Transaction Items'), ['controller' => 'TransactionItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Transaction Item'), ['controller' => 'TransactionItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="transactions index large-9 medium-8 columns content">
    <h3><?= __('Transactions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('member_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('member_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('member_paytype') ?></th>
                <th scope="col"><?= $this->Paginator->sort('member_company') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('year') ?></th>
                <th scope="col"><?= $this->Paginator->sort('month') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ref_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receipt_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_method') ?></th>
                <th scope="col"><?= $this->Paginator->sort('batch_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cheque_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('renewal_year') ?></th>
                <th scope="col"><?= $this->Paginator->sort('remarks') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subtotal') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tax') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total') ?></th>
                <th scope="col"><?= $this->Paginator->sort('valid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><?= $this->Number->format($transaction->id) ?></td>
                <td><?= $transaction->has('member') ? $this->Html->link($transaction->member->name, ['controller' => 'Members', 'action' => 'view', $transaction->member->id]) : '' ?></td>
                <td><?= h($transaction->member_name) ?></td>
                <td><?= h($transaction->member_paytype) ?></td>
                <td><?= h($transaction->member_company) ?></td>
                <td><?= h($transaction->date) ?></td>
                <td><?= $this->Number->format($transaction->year) ?></td>
                <td><?= $this->Number->format($transaction->month) ?></td>
                <td><?= h($transaction->ref_no) ?></td>
                <td><?= h($transaction->receipt_no) ?></td>
                <td><?= h($transaction->payment_method) ?></td>
                <td><?= h($transaction->batch_no) ?></td>
                <td><?= h($transaction->cheque_no) ?></td>
                <td><?= h($transaction->payment_type) ?></td>
                <td><?= $this->Number->format($transaction->renewal_year) ?></td>
                <td><?= h($transaction->remarks) ?></td>
                <td><?= $this->Number->format($transaction->subtotal) ?></td>
                <td><?= $this->Number->format($transaction->tax) ?></td>
                <td><?= $this->Number->format($transaction->total) ?></td>
                <td><?= h($transaction->valid) ?></td>
                <td><?= h($transaction->created) ?></td>
                <td><?= h($transaction->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $transaction->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $transaction->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $transaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transaction->id)]) ?>
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
