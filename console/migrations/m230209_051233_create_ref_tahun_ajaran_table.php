<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ref_tahun_ajaran}}`.
 */
class m230209_051233_create_ref_tahun_ajaran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ref_tahun_ajaran}}', [
            'id' => $this->primaryKey(),
            'tahun_ajaran' => $this->string(15)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ref_tahun_ajaran}}');
    }
}
