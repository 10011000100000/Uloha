<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateUsersTable extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     */
    public function change(): void
    {
        $table = $this->table('users');
        $table->addColumn('login', 'string')
            ->addColumn('password', 'string')
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->addIndex(['login'], ['unique' => true])
            ->create();
    }
}
