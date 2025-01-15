<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * @property int                      $id
 * @property string|null              $login
 * @property string|null              $password
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 */
class User extends Entity
{
    /**
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'login' => true,
        'password' => true,
        'created' => true,
        'modified' => true,
    ];

    /**
     * @var list<string>
     */
    protected array $_hidden = [
        'password',
    ];

    protected function _setPassword(string $password): ?string
    {
        if (\strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }

        return null;
    }
}
