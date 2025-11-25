<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOffers extends Migration
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
            'offer_number' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'unique' => true,
            ],
            'submission_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'client_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'client_address' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'client_postcode' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'client_city' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'client_email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'client_phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'project_address' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'building_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'research_area' => [
                'type' => 'TEXT',
            ],
            'research_purpose' => [
                'type' => 'TEXT',
            ],
            'number_of_analyses' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'extra_options' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'subtotal' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
            ],
            'btw_percentage' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => 21.00,
            ],
            'btw_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
            ],
            'total_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['draft', 'sent', 'accepted', 'rejected'],
                'default' => 'draft',
            ],
            'pdf_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
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
        $this->forge->addForeignKey('submission_id', 'form_submissions', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('offers');
    }

    public function down()
    {
        $this->forge->dropTable('offers');
    }
}
