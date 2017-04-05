<?php
use insolita\opcache\utils\Translator;
/**
 * @var \insolita\opcache\models\OpcacheStatus $status
**/

 echo insolita\opcache\widgets\PieWidget::widget(
    [
        'functionName'  => 'drawMemoryChart',
        'options'       => ['style' => 'width:600px;height:400px;','id'=>'memoryChart'],
        'clientOptions' => [
            'title'   => Translator::t('memory_usage')."\n"
                . Translator::status('current_wasted_percentage').' = '
                .round($status->getMemoryUsage()['current_wasted_percentage'],2).'%',
            'tooltip' => ['text' => 'percentage'],
            'legend'  => ['position' => 'right'],
            'slices'  => [
                0=>['color'=>'red'],
                1=>['color'=>'green'],
                2 => ['offset' => 0.3,'color'=>'yellow'],
            ],
            'pieHole'=> 0.3,
        ],
        'data'          => [
            ['label'=>'Memory','value'=>'Usage'],
            [
                'label' => Translator::status('used_memory')
                    . ' - ' . Yii::$app->formatter->asShortSize(
                        $status->getMemoryUsage()['used_memory']
                    ),
                'value' => $status->getMemoryUsage()['used_memory'],
            ],
            [
                'label' => Translator::status('free_memory')
                    . ' - ' . Yii::$app->formatter->asShortSize(
                        $status->getMemoryUsage()['free_memory']
                    ),
                'value' => $status->getMemoryUsage()['free_memory'],
            ],
            [
                'label' => Translator::status('wasted_memory')
                    . ' - ' . Yii::$app->formatter->asShortSize(
                        $status->getMemoryUsage()['wasted_memory']
                    ),
                'value' => $status->getMemoryUsage()['wasted_memory'],
            ],
        ],
    ]
);
echo insolita\opcache\widgets\PieWidget::widget(
    [
        'functionName'  => 'drawBufferChart',
        'options'       => ['style' => 'width:600px;height:400px;','id'=>'bufferChart'],
        'clientOptions' => [
            'title'   => Translator::status('buffer_size')
                .' - '.Yii::$app->formatter->asShortSize($status->getStringsInfo()['buffer_size']),
            'tooltip' => ['text' => 'percentage'],
            'legend'  => ['position' => 'right'],
            'slices'  => [
                0=>['color'=>'red'],
                1=>['color'=>'blue']
            ],
            'pieHole'=> 0.4,
        ],
        'data'          => [
            ['label'=>'Used','value'=>'Free'],
            
            [
                'label' => Translator::status('used_memory')
                    . ' - ' . Yii::$app->formatter->asShortSize($status->getStringsInfo()['used_memory']),
                'value' => $status->getStringsInfo()['used_memory'],
            ],
            [
                'label' => Translator::status('free_memory')
                    . ' - ' . Yii::$app->formatter->asShortSize($status->getStringsInfo()['free_memory']),
                'value' => $status->getStringsInfo()['free_memory'],
            ],
        ],
    ]
);
echo insolita\opcache\widgets\PieWidget::widget(
    [
        'functionName'  => 'drawHitsChart',
        'options'       => ['style' => 'width:600px;height:400px;','id'=>'hitsChart'],
        'clientOptions' => [
            'title'   => Translator::t('hits_misses'),
            'tooltip' => ['text' => 'percentage'],
            'legend'  => ['position' => 'right'],
            'slices'  => [
                0=>['color'=>'green'],
                1=>['color'=>'blue'],
                2=>['color'=>'pink']
            ],
            'pieHole'=> 0.4,
        ],
        'data'          => [
            ['label'=>'Hits','value'=>'Misses'],
            
            [
                'label' => Translator::status('hits')
                    . ' - ' . $status->getStatistics()['hits'],
                'value' => $status->getStatistics()['hits'],
            ],
            [
                'label' => Translator::status('misses')
                    . ' - ' . $status->getStatistics()['misses'],
                'value' => $status->getStatistics()['misses'],
            ],
            [
                'label' => Translator::status('blacklist_misses')
                    . ' - ' . $status->getStatistics()['blacklist_misses'],
                'value' =>  $status->getStatistics()['blacklist_misses'],
            ],
        ],
    ]
);
