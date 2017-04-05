<?php
use insolita\opcache\utils\Translator;

echo \yii\bootstrap\Nav::widget([
    'id' => 'opcache_nav_menu',
    'options' => ['class'=>'nav nav-tabs'],
    'encodeLabels'=>false,
    'items' => [
        [
            'label'=>Translator::t('status'),
            'url'=>['/opcache/default/index']
        ],
        [
            'label'=>Translator::t('config'),
            'url'=>['/opcache/default/config']
        ],
        [
            'label'=>Translator::t('file_list'),
            'url'=>['/opcache/default/files']
        ],
        [
            'label'=>Translator::t('black_list'),
            'url'=>['/opcache/default/black']
        ],
        [
            'label'=>Translator::t('reset'),
            'url'=>['/opcache/default/reset']
        ],
    ]
                                ]);