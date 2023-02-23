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
        'attribute'=>'refGuru.nama_guru',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Aksi',
        'template' => '{btn_delete}',
        'buttons' => [
            "btn_delete" => function ($url, $model, $key) {
                return Html::a('Hapus', ['delete-mapel', 'id' => $model->id], [
                    'class' => 'btn btn-danger text-white btn-block',
                    'title' => 'Hapus',
                    'data-toggle' => 'tooltip'
                ]);
            },

        ]
    ],

];   

