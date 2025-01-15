<?php
$this->assign('title', 'Create new product');
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions'); ?></h4>
            <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'side-nav-item']); ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users form content">
            <?= $this->Form->create($product, ['type' => 'file']); ?>
            <fieldset>
                <legend><?= __('Create new product'); ?></legend>
                <?php
                    echo $this->Form->control('name');
echo $this->Form->control('price');
echo $this->Form->control('vat', ['label' => 'DPH']);
echo $this->Form->control('img-file', ['type' => 'file', 'label' => 'Image', 'required' => true]);
echo $this->Form->label('Categories');
echo '<div class=\'categories\'>';

foreach ($categories as $category) {
    echo $this->Form->control($category->name, ['value' => 'category-' . $category->id, 'type' => 'checkbox', 'label' => $category->name]);
}
echo '</div>';
?>
            </fieldset>
            <?= $this->Form->button(__('Create'), ['type' => 'submit']); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>