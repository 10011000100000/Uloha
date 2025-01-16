<?php
$this->assign('title', 'Dashboard');
?>
<div class="dashboard">
        <?= $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']); ?>
        <?= $this->Html->link(__('Categories'), ['controller' => 'Categories', 'action' => 'index']); ?>
        <?= $this->Html->link(__('Products'), ['controller' => 'Products', 'action' => 'index']); ?>
</div>