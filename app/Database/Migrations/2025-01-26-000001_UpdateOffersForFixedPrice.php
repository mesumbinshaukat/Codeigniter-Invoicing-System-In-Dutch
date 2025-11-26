<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateOffersForFixedPrice extends Migration
{
    public function up()
    {
        $this->forge->addColumn('offers', [
            'fixed_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
                'after' => 'extra_options',
            ],
            'tarief_description' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'fixed_price',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('offers', ['fixed_price', 'tarief_description']);
    }
}
