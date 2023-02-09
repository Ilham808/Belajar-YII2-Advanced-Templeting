<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%guru_mata_pelajaran}}`.
 */
class m230209_051643_create_guru_mata_pelajaran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%guru_mata_pelajaran}}', [
            'id' => $this->primaryKey(),
            'id_guru' => $this->integer()->notNull(),
            'id_mata_pelajaran' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%guru_mata_pelajaran}}');
    }
}
