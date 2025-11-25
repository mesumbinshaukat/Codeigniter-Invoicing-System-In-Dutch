<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFormSubmissions extends Migration
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
            'naam' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'adres' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'postcode' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'woonplaats' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'telefoonnummer' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'project_adres' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'type_gebouw' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'onderzoeksgebied' => [
                'type' => 'TEXT',
            ],
            'doel_onderzoek' => [
                'type' => 'TEXT',
            ],
            'aantal_analyses' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'extra_opties' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'processed', 'archived'],
                'default' => 'pending',
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
        $this->forge->createTable('form_submissions');
    }

    public function down()
    {
        $this->forge->dropTable('form_submissions');
    }
}
