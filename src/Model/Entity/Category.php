<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * @property int                      $id
 * @property string|null              $name
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 */
class Category extends Entity
{
    protected array $_accessible = [
        'name' => true,
        'created' => true,
        'modified' => true,
    ];

    protected array $_hidden = [
    ];
}
