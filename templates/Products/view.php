<?php
$this->assign('title', $product->name . ' account details');
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions'); ?></h4>
            <?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id], ['class' => 'side-nav-item']); ?>
            <?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete {0} #{1}?', $product->name, $product->id), 'class' => 'side-nav-item']); ?>
            <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'side-nav-item']); ?>
            <?= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'side-nav-item']); ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users view content">
            <h3><?= h($product->id); ?></h3>
            <table>
                <tr>
                    <th><?= __('Name'); ?></th>
                    <td><?= h($product->name); ?></td>
                </tr>
                <tr>
                    <th><?= __('Id'); ?></th>
                    <td><?= $this->Number->format($product->id); ?></td>
                </tr>
                <tr>
                    <th><?= __('Price'); ?></th>
                    <td><?= $this->Number->format($product->price); ?></td>
                </tr>
                <tr>
                    <th><?= __('DPH'); ?></th>
                    <td><?= $this->Number->format($product->vat); ?></td>
                </tr>
                <tr>
                    <th><?= __('Image'); ?></th>
                    <td><?= $this->Html->image('/img/product_img/' . $product->img, ['class' => 'product_image', 'alt' => $product->imgName]); ?></td>
                </tr>
                <tr>
                    <th><?= __(''); ?></th>
                    <td><?= h($product->imgName); ?></td>
                </tr>
                <tr>
                    <th><?= __('Created'); ?></th>
                    <td><?= h($product->created); ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified'); ?></th>
                    <td><?= h($product->modified); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>