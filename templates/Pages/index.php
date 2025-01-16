<?php
$this->assign('title', 'Home');
?>

<div id="categories">
    <?php
        echo '<h3>Categories</h3>';

foreach ($categories as $category) {
    echo '<div>';
    echo $this->Html->link($category->name, ['?' => ['category' => $category->id]], ['class' => $this->request->getQuery('category') && $_GET['category'] == $category->id ? 'active' : null, 'style' => 'padding: 6px 5px 2.5px 5px;']);
    echo '</div>';
}
echo '<h3>Products</h3>';
echo '<div id=\'products\'>';

foreach ($products as $product) {
    echo '<div>';
    echo $this->Html->image('product_img/' . $product->img, ['class' => 'product_image', 'alt' => $product->imgName]);
    echo '<div style=\'width:90%;margin:0 auto;\'>';
    echo '<h5 style=\'text-align:center;width:100%\'>' . $product->name . '</h5>';
    echo '<div style=\'display:flex;flex-direction:row;justify-content:space-around\'>';
    echo '<h6 style=\'text-align:center\'>' . \round($product->price * ($product->vat / 100 + 1), 2) . '€</h6>';
    echo $this->Form->button(__('Add to cart'), ['data-id' => $product->id, 'class' => 'addToCart']);
    echo $this->Form->end();
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';
echo '<div id=\'cart\'>';
echo '<div>';
echo '<h6>Subtotal:</h6>';
echo '<span>' . \bcsub($cart->subtotal, 0, 2) . '€</span>';
echo '</div>';
echo '<div>';
echo '<h6>Tax:</h6>';
echo '<span>' . \bcsub($_SESSION['Cart']->getTotal(), $_SESSION['Cart']->getSubtotal(), 2) . '€</span>';
echo '</div>';
echo '<div>';
echo '<h6>Total:</h6>';
echo '<span>' . \bcsub($cart->total, 0, 2) . '€</span>';
echo '</div>';
echo '</div>';
?>
</div>