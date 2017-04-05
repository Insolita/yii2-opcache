<?php
/**
 * Created by solly [06.04.17 3:27]
 */

namespace insolita\opcache;

use insolita\opcache\contracts\IOpcacheFinder;
use insolita\opcache\contracts\IOpcachePresenter;
use insolita\opcache\services\OpcacheFinder;
use insolita\opcache\services\OpcachePresenter;
use yii\base\BootstrapInterface;

/**
 * Class Bootstrap
 *
 * @package backend\modules\opcache
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param \yii\web\Application $app the application currently running
     */
    public function bootstrap($app)
    {
        \Yii::$container->set(IOpcachePresenter::class, OpcachePresenter::class);
        \Yii::$container->set(IOpcacheFinder::class, OpcacheFinder::class);
    }
}
