<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCheckoutFieldsToTransaction extends Migration
{
    public function up()
    {
        $fields = [
            'ppn' => [
                'type'       => 'DOUBLE',
                'null'       => true,
                'after'      => 'ongkir',
            ],
            'biaya_admin' => [
                'type'       => 'DOUBLE',
                'null'       => true,
                'after'      => 'ppn',
            ],
            'voucher_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'biaya_admin',
            ],
            'diskon_voucher' => [
                'type'       => 'DOUBLE',
                'null'       => true,
                'after'      => 'voucher_code',
            ],
        ];

        $this->forge->addColumn('transaction', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('transaction', 'ppn');
        $this->forge->dropColumn('transaction', 'biaya_admin');
        $this->forge->dropColumn('transaction', 'voucher_code');
        $this->forge->dropColumn('transaction', 'diskon_voucher');
    }
}
