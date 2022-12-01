<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\I18n\Time;

class Employees extends Migration
{
    public function up()
    {
        $myTime = new Time('now', 'Asia/Karachi', 'en_US');
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'company_id_fk' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true

            ],
            'added_by' => [
                'type'           => 'VARCHAR',
                'constraint'     => '15',

            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
            'phone' => [
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
        $this->forge->addKey('employee_id', true);
        $this->forge->addForeignKey('company_id_fk', 'companies', 'company_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('employees');
    }

    public function down()
    {
        $this->forge->dropTable('employees');
    }
}
