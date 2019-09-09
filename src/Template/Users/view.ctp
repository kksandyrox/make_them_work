<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Potholes'), ['controller' => 'Potholes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pothole'), ['controller' => 'Potholes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Address') ?></h4>
        <?= $this->Text->autoParagraph(h($user->address)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Potholes') ?></h4>
        <?php if (!empty($user->potholes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Path') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Severity') ?></th>
                <th scope="col"><?= __('Comments') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->potholes as $potholes): ?>
            <tr>
                <td><?= h($potholes->id) ?></td>
                <td><?= h($potholes->user_id) ?></td>
                <td><?= h($potholes->image) ?></td>
                <td><?= h($potholes->path) ?></td>
                <td><?= h($potholes->address) ?></td>
                <td><?= h($potholes->severity) ?></td>
                <td><?= h($potholes->comments) ?></td>
                <td><?= h($potholes->created) ?></td>
                <td><?= h($potholes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Potholes', 'action' => 'view', $potholes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Potholes', 'action' => 'edit', $potholes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Potholes', 'action' => 'delete', $potholes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $potholes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
