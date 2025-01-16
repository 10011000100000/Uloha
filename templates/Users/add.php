<?php
$this->assign('title', 'Create new user');
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions'); ?></h4>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']); ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users form content">
            <?= $this->Form->create($user); ?>
            <fieldset>
                <legend><?= __('Create new user'); ?></legend>
                <?php
                    echo $this->Form->control('login');
echo $this->Form->control('password');
?>
            </fieldset>
            <?= $this->Form->button(__('Create'), ['type' => 'submit']); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>