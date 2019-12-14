<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Member $member
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Member'), ['action' => 'edit', $member->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Member'), ['action' => 'delete', $member->id], ['confirm' => __('Are you sure you want to delete # {0}?', $member->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Member'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Transactions'), ['controller' => 'Transactions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transaction'), ['controller' => 'Transactions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="members view large-9 medium-8 columns content">
    <h3><?= h($member->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($member->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($member->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= h($member->company) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($member->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('No') ?></th>
            <td><?= $this->Number->format($member->no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($member->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($member->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Valid') ?></th>
            <td><?= $member->valid ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Transactions') ?></h4>
        <?php if (!empty($member->transactions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Member Id') ?></th>
                <th scope="col"><?= __('Member Name') ?></th>
                <th scope="col"><?= __('Member Paytype') ?></th>
                <th scope="col"><?= __('Member Company') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('Year') ?></th>
                <th scope="col"><?= __('Month') ?></th>
                <th scope="col"><?= __('Ref No') ?></th>
                <th scope="col"><?= __('Receipt No') ?></th>
                <th scope="col"><?= __('Payment Method') ?></th>
                <th scope="col"><?= __('Batch No') ?></th>
                <th scope="col"><?= __('Cheque No') ?></th>
                <th scope="col"><?= __('Payment Type') ?></th>
                <th scope="col"><?= __('Renewal Year') ?></th>
                <th scope="col"><?= __('Remarks') ?></th>
                <th scope="col"><?= __('Subtotal') ?></th>
                <th scope="col"><?= __('Tax') ?></th>
                <th scope="col"><?= __('Total') ?></th>
                <th scope="col"><?= __('Valid') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($member->transactions as $transactions): ?>
            <tr>
                <td><?= h($transactions->id) ?></td>
                <td><?= h($transactions->member_id) ?></td>
                <td><?= h($transactions->member_name) ?></td>
                <td><?= h($transactions->member_paytype) ?></td>
                <td><?= h($transactions->member_company) ?></td>
                <td><?= h($transactions->date) ?></td>
                <td><?= h($transactions->year) ?></td>
                <td><?= h($transactions->month) ?></td>
                <td><?= h($transactions->ref_no) ?></td>
                <td><?= h($transactions->receipt_no) ?></td>
                <td><?= h($transactions->payment_method) ?></td>
                <td><?= h($transactions->batch_no) ?></td>
                <td><?= h($transactions->cheque_no) ?></td>
                <td><?= h($transactions->payment_type) ?></td>
                <td><?= h($transactions->renewal_year) ?></td>
                <td><?= h($transactions->remarks) ?></td>
                <td><?= h($transactions->subtotal) ?></td>
                <td><?= h($transactions->tax) ?></td>
                <td><?= h($transactions->total) ?></td>
                <td><?= h($transactions->valid) ?></td>
                <td><?= h($transactions->created) ?></td>
                <td><?= h($transactions->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Transactions', 'action' => 'view', $transactions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Transactions', 'action' => 'edit', $transactions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Transactions', 'action' => 'delete', $transactions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transactions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
