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
        'attribute'=>'mata_pelajaran',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'refTingkatKelas.tingkat_kelas',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'refJurusan.jurusan',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Tambah Guru',
        'template' => '{btn_add_guru}',
        'buttons' => [
            "btn_add_guru" => function ($url, $model, $key) {
                return Html::a('Tambah', ['add-guru', 'id' => $model->id], [
                    'class' => 'btn btn-success text-white btn-block',
                    'role' => 'modal-remote',
                    'title' => 'Tambah',
                    'data-toggle' => 'tooltip'
                ]);
            },

        ]
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Guru Pengajar',
        'template' => '{btn_detail_guru}',
        'buttons' => [
            "btn_detail_guru" => function ($url, $model, $key) {
                return Html::a('Lihat', ['detail-guru', 'id' => $model->id], [
                    'class' => 'btn btn-success text-white btn-block',
                    'role' => 'modal-remote',
                    'title' => 'Lihat',
                    'data-toggle' => 'tooltip'
                ]);
            },

        ]
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action, 'id' => $model->id]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Lihat','data-toggle'=>'tooltip', 'class' => 'text-info'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Ubah', 'data-toggle'=>'tooltip', 'class' => 'text-warning'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Hapus', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Peringatan',
                          'data-confirm-message'=>'Apakah anda yakin ingin menghapus data ini?',
                          'class' => 'text-danger'
                      ], 
    ],

];   