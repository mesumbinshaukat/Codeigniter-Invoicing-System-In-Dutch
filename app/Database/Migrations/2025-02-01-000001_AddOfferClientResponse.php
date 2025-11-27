<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOfferClientResponse extends Migration
{
    public function up()
    {
        $fields = [
            'client_response_token' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => true,
                'after' => 'tarief_description',
            ],
            'client_response_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'client_response_token',
            ],
        ];

        $this->forge->addColumn('offers', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('offers', ['client_response_token', 'client_response_at']);
    }
}
