<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%wali}}`.
 */
class m230209_051436_create_wali_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%wali}}', [
            'id' => $this->primaryKey(),
            'nama'  => $this->string(50),
            'alamat' => $this->text(),
            'no_hp' => $this->string(20),
            'id_status_wali' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%wali}}');
    }
}
