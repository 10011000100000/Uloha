<?php
$this->assign('title', 'Create new category');
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions'); ?></h4>
            <?= $this->Html->link(__('List Categories'), ['action' => 'index'], ['class' => 'side-nav-item']); ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users form content">
            <?= $this->Form->create($category); ?>
            <fieldset>
                <legend><?= __('Create new category'); ?></legend>
                <?php
                    echo $this->Form->control('name');
?>
            </fieldset>
            <?= $this->Form->button(__('Create'), ['type' => 'submit']); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>