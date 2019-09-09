<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pothole $pothole
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Potholes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="potholes form large-9 medium-8 columns content">
    <?= $this->Form->create($pothole) ?>
    <fieldset>
        <legend><?= __('Add Pothole') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('image');
            echo $this->Form->control('path');
            echo $this->Form->control('address');
            echo $this->Form->control('severity');
            echo $this->Form->control('comments');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
