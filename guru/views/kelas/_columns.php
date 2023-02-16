<?php
use yii\helpers\Url;

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
    ]
];   