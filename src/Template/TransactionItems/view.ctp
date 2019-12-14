<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TransactionItem $transactionItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Transaction Item'), ['action' => 'edit', $transactionItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Transaction Item'), ['action' => 'delete', $transactionItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transactionItem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Transaction Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transaction Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Transactions'), ['controller' => 'Transactions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transaction'), ['controller' => 'Transactions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="transactionItems view large-9 medium-8 columns content">
    <h3><?= h($transactionItem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Transaction') ?></th>
            <td><?= $transactionItem->has('transaction') ? $this->Html->link($transactionItem->transaction->id, ['controller' => 'Transactions', 'action' => 'view', $transactionItem->transaction->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uom') ?></th>
            <td><?= h($transactionItem->uom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Table') ?></th>
            <td><?= h($transactionItem->table) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($transactionItem->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($transactionItem->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit Price') ?></th>
            <td><?= $this->Number->format($transactionItem->unit_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sum') ?></th>
            <td><?= $this->Number->format($transactionItem->sum) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Table Id') ?></th>
            <td><?= $this->Number->format($transactionItem->table_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($transactionItem->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($transactionItem->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valid') ?></th>
            <td><?= $transactionItem->valid ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($transactionItem->description)); ?>
    </div>
</div>
