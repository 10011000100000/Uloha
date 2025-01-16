<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * @method \App\Model\Entity\User                                                                             newEmptyEntity()
 * @method \App\Model\Entity\User                                                                             newEntity(array<mixed> $data, array<mixed> $options = [])
 * @method array<\App\Model\Entity\User>                                                                      newEntities(array<mixed> $data, array<mixed> $options = [])
 * @method \App\Model\Entity\User                                                                             get(mixed $primaryKey, array<mixed>|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\User                                                                             findOrCreate($search, ?callable $callback = null, array<mixed> $options = [])
 * @method \App\Model\Entity\User                                                                             patchEntity(\Cake\Datasource\EntityInterface $entity, array<mixed> $data, array<mixed> $options = [])
 * @method array<\App\Model\Entity\User>                                                                      patchEntities(iterable<mixed> $entities, array<mixed> $data, array<mixed> $options = [])
 * @method \App\Model\Entity\User|false                                                                       save(\Cake\Datasource\EntityInterface $entity, array<mixed> $options = [])
 * @method \App\Model\Entity\User                                                                             saveOrFail(\Cake\Datasource\EntityInterface $entity, array<mixed> $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false saveMany(iterable<mixed> $entities, array<mixed> $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>       saveManyOrFail(iterable<mixed> $entities, array<mixed> $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>|false deleteMany(iterable<mixed> $entities, array<mixed> $options = [])
 * @method iterable<\App\Model\Entity\User>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\User>       deleteManyOrFail(iterable<mixed> $entities, array<mixed> $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * @param array<string, mixed> $config
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('login')
            ->maxLength('login', 255, 'Login length must not exceed 255 characters')
            ->notEmptyString('login')
            ->add('login', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'Account with this login already exists'
            ]);

        $validator
            ->scalar('password')
            ->minLength('password', 8, 'Password must be at least 8 characters long')
            ->maxLength('password', 255, 'Password length must not exceed 255 characters')
            ->notEmptyString('password')
            ->add('password', [
                'containsNumber' => [
                    'rule' => function ($value) {
                        if (\preg_match('~[0-9]+~', $value)) {
                            return true;
                        }

                        return false;
                    },
                    'message' => 'Password has to contain at least one number'
                ],
                'containsCapitalLetter' => [
                    'rule' => function ($value) {
                        if (\preg_match('~[A-Z]+~', $value)) {
                            return true;
                        }

                        return false;
                    },
                    'message' => 'Password has to contain at least one capital letter'
                ]
            ]);
        $validator
            ->scalar('confirm-password')
            ->notEmptyString('confirm-password')
            ->equalToField('confirm-password', 'password', 'Both passwords have to match');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['login'], ['allowMultipleNulls' => true]), ['errorField' => 'login']);

        return $rules;
    }
}
