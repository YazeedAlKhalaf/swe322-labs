<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class BigBang extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $dbName = $this->getAdapter()->getOption('name');
        $this->execute("CREATE DATABASE IF NOT EXISTS `$dbName`");

        $table = $this->table('user');
        $table->addColumn('username', 'string')
            ->addColumn('password', 'string')
            ->addIndex('username', ['unique' => true])
            ->create();
    }
}