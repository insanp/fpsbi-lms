<?php
// Migration: Add max_attempts to tasks table
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMaxAttemptsToTasks extends Migration
{
    public function up()
    {
        $fields = [
            'max_attempts' => [
                'type' => 'INT',
                'constraint' => 2,
                'default' => 3,
                'null' => false,
                'after' => 'type',
            ],
        ];
        $this->forge->addColumn('tasks', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('tasks', 'max_attempts');
    }
}
