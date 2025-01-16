<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * @method \App\Model\Entity\Category                                                                                 newEmptyEntity()
 * @method \App\Model\Entity\Category                                                                                 newEntity(array<mixed> $data, array<mixed> $options = [])
 * @method array<\App\Model\Entity\Category>                                                                          newEntities(array<mixed> $data, array<mixed> $options = [])
 * @method \App\Model\Entity\Category                                                                                 get(mixed $primaryKey, array<mixed>|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Category                                                                                 findOrCreate($search, ?callable $callback = null, array<mixed> $options = [])
 * @method \App\Model\Entity\Category                                                                                 patchEntity(\Cake\Datasource\EntityInterface $entity, array<mixed> $data, array<mixed> $options = [])
 * @method array<\App\Model\Entity\Category>                                                                          patchEntities(iterable<mixed> $entities, array<mixed> $data, array<mixed> $options = [])
 * @method \App\Model\Entity\Category|false                                                                           save(\Cake\Datasource\EntityInterface $entity, array<mixed> $options = [])
 * @method \App\Model\Entity\Category                                                                                 saveOrFail(\Cake\Datasource\EntityInterface $entity, array<mixed> $options = [])
 * @method iterable<\App\Model\Entity\Category>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Category>|false saveMany(iterable<mixed> $entities, array<mixed> $options = [])
 * @method iterable<\App\Model\Entity\Category>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Category>       saveManyOrFail(iterable<mixed> $entities, array<mixed> $options = [])
 * @method iterable<\App\Model\Entity\Category>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Category>|false deleteMany(iterable<mixed> $entities, array<mixed> $options = [])
 * @method iterable<\App\Model\Entity\Category>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Category>       deleteManyOrFail(iterable<mixed> $entities, array<mixed> $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CategoriesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('categories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255, 'Category name length must not exceed 255 characters')
            ->notEmptyString('name');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        return $rules;
    }
}
