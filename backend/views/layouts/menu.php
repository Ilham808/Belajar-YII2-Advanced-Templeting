<?php 
use yii\bootstrap5\Html;
use yii\widgets\Menu;

echo Menu::widget(
    [
        'options' => [
            'id' => 'sidebarnav'
        ],
        'items' => [
            [
                'template' => '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="/backend/site/index" aria-expanded="false">
                <i class="mdi mdi-view-dashboard"></i>
                <span class="hide-menu">Dashboard</span>
                </a>',
                'options' => [
                	'class' => 'sidebar-item'
                ],
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],
            [
                'template' => '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="/backend/mata-pelajaran/index" aria-expanded="false">
                <i class="mdi mdi-book-multiple"></i>
                <span class="hide-menu">Mata Pelajaran</span>
                </a>',
                'options' => [
                    'class' => 'sidebar-item'
                ],
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],
            [
                'template' => '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="/backend/kelas/index" aria-expanded="false">
                <i class="mdi mdi-domain"></i>
                <span class="hide-menu">Kelas</span>
                </a>',
                'options' => [
                    'class' => 'sidebar-item'
                ],
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],
            [
                'template' => '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="/backend/guru/index" aria-expanded="false">
                <i class="mdi mdi-account-multiple"></i>
                <span class="hide-menu">Guru</span>
                </a>',
                'options' => [
                    'class' => 'sidebar-item'
                ],
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],
            [
                'template' => '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="/backend/peta-mata-pelajaran/index" aria-expanded="false">
                <i class="mdi mdi-account-multiple"></i>
                <span class="hide-menu">Mata Pelajaran Guru</span>
                </a>',
                'options' => [
                    'class' => 'sidebar-item'
                ],
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],
            [
                'template' => '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="/backend/siswa/index" aria-expanded="false">
                <i class="mdi mdi-account-multiple"></i>
                <span class="hide-menu">Siswa</span>
                </a>',
                'options' => [
                    'class' => 'sidebar-item'
                ],
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],
            [
                'template' => '<span>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'sidebar-link waves-effect waves-dark sidebar-link logout']
                )
                . Html::endForm()
                . '<span/>',
                'options' => [
                    'class' => 'sidebar-item'
                ],
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],
        ]
    ]
);

?>