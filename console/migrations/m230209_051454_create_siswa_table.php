<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%siswa}}`.
 */
class m230209_051454_create_siswa_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%siswa}}', [
            'id' => $this->primaryKey(),
            'nis' => $this->string(20),
            'nama'  => $this->string(50),
            'tempat_lahir' => $this->string(20),
            'tanggal_lahir' => $this->date(),
            'alamat' => $this->text(),
            'id_kelas' => $this->integer()->notNull(),
            'id_user' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%siswa}}');
    }
}
