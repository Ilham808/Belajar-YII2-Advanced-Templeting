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
        'attribute'=>'nama_guru',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Akun',
        'template' => '{btn_add_akun}',
        'buttons' => [
            "btn_add_akun" => function ($url, $model, $key) {

                if ($model->id_user == 0) {
                    return Html::a('Buat Akun', ['add-akun', 'id' => $model->id], [
                        'class' => 'btn btn-success text-white btn-block',
                        'role' => 'modal-remote',
                        'title' => 'Buat Akun',
                        'data-toggle' => 'tooltip'
                    ]);
                }else{
                    return Html::a('Lihat Akun', ['view-akun', 'id' => $model->id_user], [
                        'class' => 'btn btn-primary text-white btn-block',
                        'role' => 'modal-remote',
                        'title' => 'Lihat Akun',
                        'data-toggle' => 'tooltip'
                    ]);
                }
                
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
        'viewOptions'=>['role'=>'modal-remote','title'=>'Lihat','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Ubah', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Hapus', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Peringatan',
                          'data-confirm-message'=>'Apakah anda yakin ingin menghapus data ini?'], 
    ],

];   