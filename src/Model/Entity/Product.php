<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * @property int                      $id
 * @property string                   $name
 * @property float                    $price
 * @property int                      $vat
 * @property string|null              $img
 * @property string|null              $imgName
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 */
class Product extends Entity
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
}
