<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * @method \App\Model\Entity\Product                                                                                newEmptyEntity()
 * @method \App\Model\Entity\Product                                                                                newEntity(array<mixed> $data, array<mixed> $options = [])
 * @method array<\App\Model\Entity\Product>                                                                         newEntities(array<mixed> $data, array<mixed> $options = [])
 * @method \App\Model\Entity\Product                                                                                get(mixed $primaryKey, array<mixed>|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Product                                                                                findOrCreate($search, ?callable $callback = null, array<mixed> $options = [])
 * @method \App\Model\Entity\Product                                                                                patchEntity(\Cake\Datasource\EntityInterface $entity, array<mixed> $data, array<mixed> $options = [])
 * @method array<\App\Model\Entity\Product>                                                                         patchEntities(iterable<mixed> $entities, array<mixed> $data, array<mixed> $options = [])
 * @method \App\Model\Entity\Product|false                                                                          save(\Cake\Datasource\EntityInterface $entity, array<mixed> $options = [])
 * @method \App\Model\Entity\Product                                                                                saveOrFail(\Cake\Datasource\EntityInterface $entity, array<mixed> $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>|false saveMany(iterable<mixed> $entities, array<mixed> $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>       saveManyOrFail(iterable<mixed> $entities, array<mixed> $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>|false deleteMany(iterable<mixed> $entities, array<mixed> $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>       deleteManyOrFail(iterable<mixed> $entities, array<mixed> $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('products');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('name')
            ->scalar('name')
            ->maxLength('name', 255, 'Product name length must not exceed 255 characters');

        $validator
            ->notBlank('price')
            ->decimal('price', null, 'Price has to be decimal number')
            ->greaterThanOrEqual('price', 0, 'Price can\'t be lesser than 0');

        $validator
            ->notBlank('vat')
            ->integer('vat', 'DPH has to be number')
            ->greaterThanOrEqual('vat', 0, 'Tax can\'t be lower than 0')
            ->lessThanOrEqual('vat', 100, 'Max tax is 100%');

        $validator
            ->allowEmptyFile('img-file')
            ->uploadedFile('img-file', [
                'types' => ['image/png', 'image/jpg', 'image/jpeg'],
                'minSize' => 1024,
                'maxSize' => 5120000,
            ], 'Image has to be either jpg or png and between 1kB and 5MB in size');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        return $rules;
    }
}
