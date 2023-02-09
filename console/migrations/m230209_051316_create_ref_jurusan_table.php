<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ref_jurusan}}`.
 */
class m230209_051316_create_ref_jurusan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ref_jurusan}}', [
            'id' => $this->primaryKey(),
            'jurusan' => $this->string(15)
        ]);

        $this->batchInsert(
            'ref_jurusan',
            [
                'jurusan',
            ],
            [
                ['UMUM'],
                ['IPA'],
                ['IPS'],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ref_jurusan}}');
    }
}
