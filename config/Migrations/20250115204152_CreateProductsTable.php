<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateProductsTable extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     */
    public function change(): void
    {
        $table = $this->table('products');
        $table->addColumn('name', 'string')
            ->addColumn('price', 'decimal', ['precision' => 6, 'scale' => 2])
            ->addColumn('vat', 'integer')
            ->addColumn('img', 'string')
            ->addColumn('imgName', 'string')
            ->addColumn('quantity', 'integer', ['null' => true, 'default' => null])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();
    }
}
