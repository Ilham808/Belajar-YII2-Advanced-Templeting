<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%siswa_rw_kelas}}`.
 */
class m230209_051605_create_siswa_rw_kelas_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%siswa_rw_kelas}}', [
            'id' => $this->primaryKey(),
            'id_siswa' => $this->integer()->notNull(),
            'id_kelas'  => $this->integer()->notNull(),
            'id_tahun_ajaran'   => $this->integer()->notNull(),
            'nama_kelas' => $this->string(20),
            'id_tingkat' => $this->integer()->notNull(),
            'id_wali_kelas' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%siswa_rw_kelas}}');
    }
}
