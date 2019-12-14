<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transaction $transaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $transaction->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $transaction->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Transactions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Members'), ['controller' => 'Members', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Member'), ['controller' => 'Members', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Transaction Items'), ['controller' => 'TransactionItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Transaction Item'), ['controller' => 'TransactionItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="transactions form large-9 medium-8 columns content">
    <?= $this->Form->create($transaction) ?>
    <fieldset>
        <legend><?= __('Edit Transaction') ?></legend>
        <?php
            echo $this->Form->control('member_id', ['options' => $members]);
            echo $this->Form->control('member_name');
            echo $this->Form->control('member_paytype');
            echo $this->Form->control('member_company');
            echo $this->Form->control('date', ['empty' => true]);
            echo $this->Form->control('year');
            echo $this->Form->control('month');
            echo $this->Form->control('ref_no');
            echo $this->Form->control('receipt_no');
            echo $this->Form->control('payment_method');
            echo $this->Form->control('batch_no');
            echo $this->Form->control('cheque_no');
            echo $this->Form->control('payment_type');
            echo $this->Form->control('renewal_year');
            echo $this->Form->control('remarks');
            echo $this->Form->control('subtotal');
            echo $this->Form->control('tax');
            echo $this->Form->control('total');
            echo $this->Form->control('valid');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
