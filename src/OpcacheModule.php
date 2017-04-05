<?php
/**
 * Created by solly [05.04.17 15:17]
 */

namespace insolita\opcache;

use yii\base\Module;

/**
 * Class OpcacheModule
 *
 * @package insolita\opcache
 */
class OpcacheModule extends Module
{
    /**
     * @var string
     */
    public $controllerNamespace = __NAMESPACE__.'\controllers';
    
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }
    
    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['opcache/*'] = [
            'class'          => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath'       => '@insolita/opcache/messages',
            'fileMap'        => [
                'opcache/interface' => 'interface.php',
                'opcache/hint'       => 'hint.php',
                'opcache/status'       => 'status.php',
            ],
        ];
    }
}
