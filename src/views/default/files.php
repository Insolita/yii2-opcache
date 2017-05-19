<?php

use insolita\opcache\utils\Translator;
use yii\grid\GridView;

/**
 * @var \yii\web\View                                   $this
 * @var \insolita\opcache\controllers\DefaultController $context
 * @var string                                          $version
 * @var \insolita\opcache\models\FileFilterModel        $searchModel
 * @var \yii\data\ArrayDataProvider                     $provider
 **/
$this->title = $version;

?>

<div class="panel panel-info">
	<div class="panel-heading">
		<div class="panel-title"><?= $version ?></div>
	</div>
	<div class="panel-body">
        <?= $this->render('_menu') ?>
        <?= GridView::widget(
            [
            	'filterModel' => $searchModel,
                'dataProvider' => $provider,
                'layout'       => "<span class='pull-right'>{summary}</span>{pager}\n{items}\n{pager}",
                'columns'      => [
                    [
                        'class'    => \yii\grid\ActionColumn::class,
                        'buttons'  => [
                            'flush' => function ($url, $model) {
                                return \yii\helpers\Html::a(
                                    Translator::t('invalidate'),
                                    ['invalidate','file'=>$model['full_path']],
                                    [
                                        'data-method' => 'post',
                                        'class'       => 'btn btn-default btn-sm',
                                    ]
                                );
                            },
                        ],
                        'template' => '{flush}',
                    ],
                    [
                        'attribute' => 'full_path',
                        'format'    => 'raw',
                        'label'     => Translator::t('full_path'),
                    ],
                    [
                        'attribute' => 'hits',
                        'label'     => Translator::t('hits'),
                    ],
                    [
                        'attribute' => 'memory_consumption',
                        'format'    => 'size',
                        'label'     => Translator::t('memory_consumption'),
                    ],
                    [
                        'attribute' => 'timestamp',
                        'format'    => 'datetime',
                        'label'     => Translator::t('file_timestamp'),
                    ],
                    [
                        'attribute' => 'last_used_timestamp',
                        'format'    => 'datetime',
                        'label'     => Translator::t('last_used_timestamp'),
                    ],
                    
                ],
            ]
        ); ?>
	</div>
    <?php if(!empty($searchModel->full_path) && $provider->getTotalCount()>1):?>
		<div class="panel-footer">
            <?=\yii\helpers\Html::beginForm(['invalidate-partial'],'post')?>
            <?=\yii\helpers\Html::activeHiddenInput($searchModel, 'full_path');?>
            <?=\yii\helpers\Html::submitButton(Translator::t('reset_founded_files'),
                                               ['class'=>'btn btn-success'])?>
            <?=\yii\helpers\Html::endForm()?>
		</div>
    <?php endif;?>
</div>
