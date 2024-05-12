<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddStudentSessionRelation extends AbstractMigration
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
        $this->table('student_session')
            ->addColumn('student_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('session_id', 'integer', ['null' => false, 'signed' => false])
            ->addForeignKey('student_id', 'user', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->addForeignKey('session_id', 'session', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();
    }
}
