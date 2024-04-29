<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddClassesWithSessions extends AbstractMigration
{
    public function change(): void
    {
        $classTable = $this->table('class');
        $classTable->addColumn('name', 'string', ['null' => false])
            ->addColumn('teacher_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('password', 'string', ['null' => false])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey('teacher_id', 'user', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();

        $sessionTable = $this->table('session');
        $sessionTable->addColumn('class_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('start_datetime', 'datetime', ['null' => false])
            ->addColumn('end_datetime', 'datetime', ['null' => false])
            ->addColumn('location', 'string', ['null' => true])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey('class_id', 'class', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();

        $studentClassTable = $this->table('student_class');
        $studentClassTable->addColumn('student_id', 'integer', ['null' => false, 'signed' => false])
            ->addColumn('class_id', 'integer', ['null' => false, 'signed' => false])
            ->addForeignKey('student_id', 'user', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->addForeignKey('class_id', 'class', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();
    }
}
