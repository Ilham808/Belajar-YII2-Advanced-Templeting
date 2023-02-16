<?php
use yii\helpers\Url;
use yii\helpers\Html;

return [
    //[
        //'class' => 'kartik\grid\CheckboxColumn',
        //'width' => '20px',
    //],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'refTahunAjaran.tahun_ajaran',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama_kelas',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'refTingkatKelas.tingkat_kelas',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'guru.nama_guru',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'refJurusan.jurusan',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Daftar Siswa',
        'template' => '{btn_detail}',
        'buttons' => [
            "btn_detail" => function ($url, $model, $key) {
                return Html::a('Lihat', ['list-siswa', 'id' => $model->id], [
                    'class' => 'btn btn-success text-white btn-block',
                    'role' => 'modal-remote',
                    'title' => 'Lihat',
                    'data-toggle' => 'tooltip'
                ]);
            },

        ]
    ],
];   