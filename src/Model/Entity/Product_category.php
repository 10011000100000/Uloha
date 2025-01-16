<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * @property int                      $id
 * @property int|null                 $category_id
 * @property int|null                 $product_id
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 */
class Product_category extends Entity
{
    protected array $_accessible = [
        'category_id' => true,
        'product_id' => true,
        'created' => true,
        'modified' => true,
    ];

    protected array $_hidden = [
    ];
}
