<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCounters extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'year' => [
                'type' => 'INT',
                'constraint' => 4,
            ],
            'month' => [
                'type' => 'INT',
                'constraint' => 2,
            ],
            'counter' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['year', 'month']);
        $this->forge->createTable('counters');
    }

    public function down()
    {
        $this->forge->dropTable('counters');
    }
}
