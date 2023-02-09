<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ref_tingkat_kelas}}`.
 */
class m230209_051303_create_ref_tingkat_kelas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ref_tingkat_kelas}}', [
            'id' => $this->primaryKey(),
            'tingkat_kelas' => $this->string(10)
        ]);

        $this->batchInsert(
            'ref_tingkat_kelas',
            [
                'tingkat_kelas',
            ],
            [
                ['X'],
                ['XI'],
                ['XII'],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ref_tingkat_kelas}}');
    }
}
