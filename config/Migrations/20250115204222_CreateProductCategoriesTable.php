<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateProductCategoriesTable extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     */
    public function change(): void
    {
        $table = $this->table('product_categories');
        $table->addColumn('category_id', 'integer')
            ->addColumn('product_id', 'integer')
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();
    }
}
