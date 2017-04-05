<?php
/**
 * Created by solly [05.04.17 22:43]
 */

namespace insolita\opcache\widgets;

use yii\base\InvalidConfigException;
use yii\bootstrap\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;

/**
 * Class PieWidget
 *
 * @package backend\modules\opcache\widgets
 */
class PieWidget extends Widget
{
    /**
     * @var string
     */
    public $functionName;
    
    /**
     * @var string
     */
    public $clientOptions = [];
    
    /**
     * @var array $data ['label'=>'The label','value'=>'The value']
     **/
    public $data = [];
    
    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if (empty($this->data)||!$this->functionName) {
            throw new InvalidConfigException();
        }
        if (!isset($this->options['id'])) {
            $this->options['id'] = 'memoryChart';
        }
        if (!isset($this->options['style'])) {
            $this->options['style'] = 'width:500px;height:400px';
        }
        parent::init();
        $this->registerHeadScript();
        $this->registerScript($this->options['id'],
                              $this->functionName,
                              Json::encode($this->clientOptions),
                              $this->prepareData($this->data));
    }
    
    /**
     * @return string
     */
    public function run()
    {
        return Html::tag('div', '', $this->options);
    }
    
    /**
     *
     */
    private function registerHeadScript()
    {
        $this->getView()->registerJsFile(
            'https://www.gstatic.com/charts/loader.js',
            ['position' => View::POS_HEAD],
            'google_chart'
        );
        $this->getView()->registerJs(
            "google.charts.load('current', {'packages':['corechart']});",
            View::POS_HEAD,
            'google_chart_package'
        );
    }
    
    /**
     * @param $data
     *
     * @return string
     */
    private function prepareData($data)
    {
        $chartData = [
        ];
        foreach ($data as $row) {
            $chartData[] = [$row['label'], $row['value']];
        }
        unset($data);
        return Json::encode($chartData);
    }
    
    /**
     * @param $selector
     * @param $functionName
     * @param $options
     * @param $data
     */
    private function registerScript($selector, $functionName, $options, $data)
    {
        $js
            = <<<JS
      google.charts.setOnLoadCallback({$functionName});

      function {$functionName}() {

        var {$functionName}_data = google.visualization.arrayToDataTable($data);

        var options = $options;

        var chart = new google.visualization.PieChart(document.getElementById("{$selector}"));

        chart.draw({$functionName}_data, options);
       }
JS;
        $this->getView()->registerJs($js, View::POS_HEAD);
    }
}
