<?php
$this->assign('title', 'Log In');
?>
<div class="row">
    <div class="column column-80">
        <?= $this->Flash->render(); ?>
        <div class="users form content">
            <?= $this->Form->create(); ?>
            <fieldset>
                <legend><?= __('Log In'); ?></legend>
                <?php
                    echo $this->Form->control('login', ['required' => true]);
echo $this->Form->control('password', ['required' => true]);
?>
            </fieldset>
            <?= $this->Form->button(__('Log In'), ['type' => 'submit']); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>