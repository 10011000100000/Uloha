<?php
$this->assign('title', 'Edit category ' . $category->name);
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions'); ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $category->id],
                ['confirm' => __('Are you sure you want to delete category {0} #{1}?', $category->name, $category->id), 'class' => 'side-nav-item']
            ); ?>
            <?= $this->Html->link(__('List Categories'), ['action' => 'index'], ['class' => 'side-nav-item']); ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users form content">
            <?= $this->Form->create($category); ?>
            <fieldset>
                <legend><?= __('Edit Category'); ?></legend>
                <?php
                                            echo $this->Form->control('name');
?>
            </fieldset>
            <?= $this->Form->button(__('Submit')); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>