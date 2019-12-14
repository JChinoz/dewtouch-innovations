<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transaction $transaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Transaction'), ['action' => 'edit', $transaction->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Transaction'), ['action' => 'delete', $transaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transaction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Transactions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transaction'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Transaction Items'), ['controller' => 'TransactionItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transaction Item'), ['controller' => 'TransactionItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="transactions view large-9 medium-8 columns content">
    <h3><?= h($transaction->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Member') ?></th>
            <td><?= $transaction->has('member') ? $this->Html->link($transaction->member->name, ['controller' => 'Members', 'action' => 'view', $transaction->member->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Member Name') ?></th>
            <td><?= h($transaction->member_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Member Paytype') ?></th>
            <td><?= h($transaction->member_paytype) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Member Company') ?></th>
            <td><?= h($transaction->member_company) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ref No') ?></th>
            <td><?= h($transaction->ref_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receipt No') ?></th>
            <td><?= h($transaction->receipt_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Method') ?></th>
            <td><?= h($transaction->payment_method) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Batch No') ?></th>
            <td><?= h($transaction->batch_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cheque No') ?></th>
            <td><?= h($transaction->cheque_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Type') ?></th>
            <td><?= h($transaction->payment_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Remarks') ?></th>
            <td><?= h($transaction->remarks) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($transaction->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Year') ?></th>
            <td><?= $this->Number->format($transaction->year) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Month') ?></th>
            <td><?= $this->Number->format($transaction->month) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Renewal Year') ?></th>
            <td><?= $this->Number->format($transaction->renewal_year) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subtotal') ?></th>
            <td><?= $this->Number->format($transaction->subtotal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tax') ?></th>
            <td><?= $this->Number->format($transaction->tax) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total') ?></th>
            <td><?= $this->Number->format($transaction->total) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($transaction->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($transaction->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($transaction->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valid') ?></th>
            <td><?= $transaction->valid ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Transaction Items') ?></h4>
        <?php if (!empty($transaction->transaction_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Transaction Id') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Quantity') ?></th>
                <th scope="col"><?= __('Unit Price') ?></th>
                <th scope="col"><?= __('Uom') ?></th>
                <th scope="col"><?= __('Sum') ?></th>
                <th scope="col"><?= __('Valid') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Table') ?></th>
                <th scope="col"><?= __('Table Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($transaction->transaction_items as $transactionItems): ?>
            <tr>
                <td><?= h($transactionItems->id) ?></td>
                <td><?= h($transactionItems->transaction_id) ?></td>
                <td><?= h($transactionItems->description) ?></td>
                <td><?= h($transactionItems->quantity) ?></td>
                <td><?= h($transactionItems->unit_price) ?></td>
                <td><?= h($transactionItems->uom) ?></td>
                <td><?= h($transactionItems->sum) ?></td>
                <td><?= h($transactionItems->valid) ?></td>
                <td><?= h($transactionItems->created) ?></td>
                <td><?= h($transactionItems->modified) ?></td>
                <td><?= h($transactionItems->table) ?></td>
                <td><?= h($transactionItems->table_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TransactionItems', 'action' => 'view', $transactionItems->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TransactionItems', 'action' => 'edit', $transactionItems->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TransactionItems', 'action' => 'delete', $transactionItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transactionItems->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
