<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%siswa_wali}}`.
 */
class m230209_051506_create_siswa_wali_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%siswa_wali}}', [
            'id' => $this->primaryKey(),
            'id_siswa' => $this->integer()->notNull(),
            'id_wali' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%siswa_wali}}');
    }
}
