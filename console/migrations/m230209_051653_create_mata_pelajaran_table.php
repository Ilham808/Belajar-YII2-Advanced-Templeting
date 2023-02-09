<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%mata_pelajaran}}`.
 */
class m230209_051653_create_mata_pelajaran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%mata_pelajaran}}', [
            'id' => $this->primaryKey(),
            'mata_pelajaran' => $this->string(30),
            'id_tingkat_kelas' => $this->integer()->notNull(),
            'id_jurusan' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mata_pelajaran}}');
    }
}
