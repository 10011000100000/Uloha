<?php
$this->assign('title', 'Sign Up');
?>
<div class="row">
    <div class="column column-80">
        <div class="users form content">
            <?= $this->Form->create($user); ?>
            <fieldset>
                <legend><?= __('Sign Up'); ?></legend>
                <?php
                    echo $this->Form->control('login');
echo $this->Form->control('password');
echo $this->Form->control('confirm-password', ['type' => 'password', 'label' => 'Confirm Password']);
?>
            </fieldset>
            <?= $this->Form->button(__('Sign up'), ['type' => 'submit']); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>