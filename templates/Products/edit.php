<?php
$this->assign('title', 'Edit product ' . $product->name);
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions'); ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $product->id],
                ['confirm' => __('Are you sure you want to delete product {0} #{1}?', $product->name, $product->id), 'class' => 'side-nav-item']
            ); ?>
            <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'side-nav-item']); ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users form content">
            <?= $this->Form->create($product, ['type' => 'file']); ?>
            <fieldset>
                <legend><?= __('Edit Product'); ?></legend>
                <?php
                                            echo $this->Form->control('name');
echo $this->Form->control('price');
echo $this->Form->control('vat', ['label' => 'DPH']);
echo $this->Form->label('Image');
echo $this->Html->image('/img/product_img/' . $product->img, ['class' => 'product_image', 'alt' => $product->imgName]);
echo '<h4>' . $product->imgName . '</h4>';
echo $this->Form->file('img-file');
echo $this->Form->label('Categories');
echo '<div class=\'categories\'>';

foreach ($categories as $category) {
    echo $this->Form->control($category->name, ['value' => 'category-' . $category->id, 'type' => 'checkbox', 'label' => $category->name, 'checked' => \in_array($category->id, $productCategories)]);
}
echo '</div>';
?>
            </fieldset>
            <?= $this->Form->button(__('Submit')); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>