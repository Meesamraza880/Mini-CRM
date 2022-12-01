<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\I18n\Time;

class Companies extends Migration
{
    public function up()
    {
       $myTime = new Time('now', 'Asia/Karachi', 'en_US');
        $this->forge->addField([
            'company_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'website' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => $myTime

            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => $myTime

            ]
        ]);
        $this->forge->addKey('company_id', true);
        $this->forge->createTable('companies');
    }

    public function down()
    {
        $this->forge->dropTable('companies');
    }
}
