<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * @method \App\Model\Entity\Product_category                                                                                         newEmptyEntity()
 * @method \App\Model\Entity\Product_category                                                                                         newEntity(array<mixed> $data, array<mixed> $options = [])
 * @method array<\App\Model\Entity\Product_category>                                                                                  newEntities(array<mixed> $data, array<mixed> $options = [])
 * @method \App\Model\Entity\Product_category                                                                                         get(mixed $primaryKey, array<mixed>|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Product_category                                                                                         findOrCreate($search, ?callable $callback = null, array<mixed> $options = [])
 * @method \App\Model\Entity\Product_category                                                                                         patchEntity(\Cake\Datasource\EntityInterface $entity, array<mixed> $data, array<mixed> $options = [])
 * @method array<\App\Model\Entity\Product_category>                                                                                  patchEntities(iterable<mixed> $entities, array<mixed> $data, array<mixed> $options = [])
 * @method \App\Model\Entity\Product_category|false                                                                                   save(\Cake\Datasource\EntityInterface $entity, array<mixed> $options = [])
 * @method \App\Model\Entity\Product_category                                                                                         saveOrFail(\Cake\Datasource\EntityInterface $entity, array<mixed> $options = [])
 * @method iterable<\App\Model\Entity\Product_category>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product_category>|false saveMany(iterable<mixed> $entities, array<mixed> $options = [])
 * @method iterable<\App\Model\Entity\Product_category>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product_category>       saveManyOrFail(iterable<mixed> $entities, array<mixed> $options = [])
 * @method iterable<\App\Model\Entity\Product_category>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product_category>|false deleteMany(iterable<mixed> $entities, array<mixed> $options = [])
 * @method iterable<\App\Model\Entity\Product_category>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product_category>       deleteManyOrFail(iterable<mixed> $entities, array<mixed> $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class Product_categoriesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('product_categories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        return $rules;
    }
}
