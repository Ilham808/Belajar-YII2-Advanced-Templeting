<?php
use yii\helpers\Url;
use yii\helpers\HTML;

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
        'attribute'=>'tingkat_kelas',
        'value' => function ($model) {
            return $model->refTingkatKelas->tingkat_kelas;
        },
        'label' => 'Tingkat Kelas'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute' => "jurusan",
        'value' => function ($model) {
            return $model->refJurusan->jurusan;
        },
        'label' => 'Jurusan'

    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Guru Pengajar',
        'template' => '{btn_detail_guru}',
        'buttons' => [
            "btn_detail_guru" => function ($url, $model, $key) {
                return Html::a('Lihat', ['/mapel-guru/index', 'id_mapel' => $model->id], [
                    'class' => 'btn btn-success text-white btn-block',
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