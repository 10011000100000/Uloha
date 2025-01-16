<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Riesenia\Cart\CartContext;
use Riesenia\Cart\CartItemInterface;

/**
 * @property int                      $id
 * @property string                   $name
 * @property float                    $price
 * @property int                      $vat
 * @property string|null              $img
 * @property string|null              $imgName
 * @property float                    $quantity
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 */
class Product extends Entity implements CartItemInterface
{
    /**
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'name' => true,
        'price' => true,
        'vat' => true,
        'img' => true,
        'imgName' => true,
        'created' => true,
        'modified' => true,
    ];

    /**
     * @var list<string>
     */
    protected array $_hidden = [
    ];

    public function getCartId(): string
    {
        return \strval($this->id);
    }

    public function getCartType(): string
    {
        return 'product';
    }

    public function getCartName(): string
    {
        return $this->name;
    }

    public function setCartContext(CartContext $context): void
    {
    }

    public function setCartQuantity(float $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getCartQuantity(): float
    {
        return $this->quantity;
    }

    public function getUnitPrice(): float
    {
        return \floatval($this->price);
    }

    public function getTaxRate(): float
    {
        return \floatval($this->vat);
    }
}
