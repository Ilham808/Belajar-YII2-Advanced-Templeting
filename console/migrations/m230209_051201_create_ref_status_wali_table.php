<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ref_status_wali}}`.
 */
class m230209_051201_create_ref_status_wali_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ref_status_wali}}', [
            'id' => $this->primaryKey(),
            'status_wali' => $this->string(30)
        ]);

        $this->batchInsert(
            'ref_status_wali',
            [
                'status_wali',
            ],
            [
                ['Ayah Kandung'],
                ['Ibu Kandung'],
                ['Keluarga'],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ref_status_wali}}');
    }
}
