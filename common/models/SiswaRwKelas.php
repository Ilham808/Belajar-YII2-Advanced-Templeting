<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "siswa_rw_kelas".
 *
 * @property int $id
 * @property int $id_siswa
 * @property int $id_kelas
 * @property int $id_tahun_ajaran
 * @property string|null $nama_kelas
 * @property int $id_tingkat
 * @property int $id_wali_kelas
 */
class SiswaRwKelas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'siswa_rw_kelas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_siswa', 'id_kelas', 'id_tahun_ajaran', 'id_tingkat', 'id_wali_kelas'], 'required'],
            [['id_siswa', 'id_kelas', 'id_tahun_ajaran', 'id_tingkat', 'id_wali_kelas'], 'default', 'value' => null],
            [['id_siswa', 'id_kelas', 'id_tahun_ajaran', 'id_tingkat', 'id_wali_kelas'], 'integer'],
            [['nama_kelas'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_siswa' => 'Id Siswa',
            'id_kelas' => 'Id Kelas',
            'id_tahun_ajaran' => 'Id Tahun Ajaran',
            'nama_kelas' => 'Nama Kelas',
            'id_tingkat' => 'Id Tingkat',
            'id_wali_kelas' => 'Id Wali Kelas',
        ];
    }
}
