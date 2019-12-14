<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TransactionItem $transactionItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Transaction Items'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Transactions'), ['controller' => 'Transactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Transaction'), ['controller' => 'Transactions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="transactionItems form large-9 medium-8 columns content">
    <?= $this->Form->create($transactionItem) ?>
    <fieldset>
        <legend><?= __('Add Transaction Item') ?></legend>
        <?php
            echo $this->Form->control('transaction_id', ['options' => $transactions]);
            echo $this->Form->control('description');
            echo $this->Form->control('quantity');
            echo $this->Form->control('unit_price');
            echo $this->Form->control('uom');
            echo $this->Form->control('sum');
            echo $this->Form->control('valid');
            echo $this->Form->control('table');
            echo $this->Form->control('table_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
