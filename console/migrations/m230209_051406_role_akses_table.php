<?php

use yii\db\Migration;

/**
 * Class m230209_051406_role_akses_table
 */
class m230209_051406_role_akses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            'auth_item',
            [
                'name',
                'type',
                'description',
                'rule_name',
                'data',
                'created_at',
                'updated_at'
            ],
            [
                [
                    'Admin', 1, NULL, NULL, NULL, time(), time()
                ],
                [
                    'Siswa', 1, NULL, NULL, NULL, time(), time()
                ],
                [
                    'Guru', 1, NULL, NULL, NULL, time(), time()
                ],
            ]
        );

        $this->batchInsert(
            'auth_assignment',
            [
                'item_name',
                'user_id',
                'created_at',
            ],
            [
                [
                    'Admin',
                    '1',
                    NULL
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230209_051406_role_akses_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230209_051406_role_akses_table cannot be reverted.\n";

        return false;
    }
    */
}
