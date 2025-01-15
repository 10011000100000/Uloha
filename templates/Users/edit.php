<?php
$this->assign('title', 'Edit user ' . $user->login);
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions'); ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete user {0} #{1}?', $user->login, $user->id), 'class' => 'side-nav-item']
            ); ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']); ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users form content">
            <?= $this->Form->create($user); ?>
            <fieldset>
                <legend><?= __('Edit User'); ?></legend>
                <?php
                                            echo $this->Form->control('login');
echo $this->Form->control('password', ['value' => '']);
?>
            </fieldset>
            <?= $this->Form->button(__('Submit')); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>