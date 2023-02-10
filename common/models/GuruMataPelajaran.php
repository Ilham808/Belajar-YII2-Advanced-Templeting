<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "guru_mata_pelajaran".
 *
 * @property int $id
 * @property int $id_guru
 * @property int $id_mata_pelajaran
 */
class GuruMataPelajaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guru_mata_pelajaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_guru', 'id_mata_pelajaran'], 'required'],
            [['id_guru', 'id_mata_pelajaran'], 'default', 'value' => null],
            [['id_guru', 'id_mata_pelajaran'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_guru' => 'Id Guru',
            'id_mata_pelajaran' => 'Id Mata Pelajaran',
        ];
    }
}
