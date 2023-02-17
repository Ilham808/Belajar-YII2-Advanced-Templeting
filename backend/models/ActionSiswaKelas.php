<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Siswa;
use common\models\Kelas;
use common\models\SiswaRwKelas;

class ActionSiswaKelas extends Model
{
	public function updateSiswaKelas($post)
	{
		$getKelas = Kelas::findOne($post['Siswa']['id_kelas']);

		foreach ($post['Siswa']['id'] as $key) {
			if ($key != null) {	
				$siswa = Siswa::find()->where(['id' => $key])->one();
				$siswa->id_kelas = $post['Siswa']['id_kelas'];
				$siswa->save();

				$createKelas = new SiswaRwKelas();
				$createKelas->id_siswa = $key;
				$createKelas->id_kelas = $post['Siswa']['id_kelas'];
				$createKelas->id_tahun_ajaran = $getKelas->id_tahun_ajaran;
				$createKelas->nama_kelas = $getKelas->nama_kelas;
				$createKelas->id_tingkat = $getKelas->id_tingkat;
				$createKelas->id_wali_kelas = $getKelas->id_wali_kelas;
				$createKelas->save();
			}
		}

		return TRUE;
	}
} 