<?php 

use yii\widgets\Menu;

echo Menu::widget(
    [
        'options' => [
            'id' => 'sidebarnav'
        ],
        'items' => [
            [
                'template' => '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="/siswa/site/index" aria-expanded="false">
                <i class="mdi mdi-view-dashboard"></i>
                <span class="hide-menu">Dashboard</span>
                </a>',
                'options' => [
                	'class' => 'sidebar-item'
                ],
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],

            [
                'template' => '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="/siswa/biodata/index" aria-expanded="false">
                <i class="mdi mdi-calendar"></i>
                <span class="hide-menu">Biodata</span>
                </a>',
                'options' => [
                    'class' => 'sidebar-item'
                ],
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],

            [
                'template' => '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="/siswa/riwayat/index" aria-expanded="false">
                <i class="mdi mdi-calendar"></i>
                <span class="hide-menu">Riwayat Siswa</span>
                </a>',
                'options' => [
                    'class' => 'sidebar-item'
                ],
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],
            [
                'template' => '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="/siswa/wali/index" aria-expanded="false">
                <i class="mdi mdi-calendar"></i>
                <span class="hide-menu">Wali Murid</span>
                </a>',
                'options' => [
                	'class' => 'sidebar-item'
                ],
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],
        ]
    ]
);

?>