<?php
/**
 * Created by solly [05.04.17 15:05]
 */

namespace insolita\opcache\controllers;

use insolita\opcache\contracts\IOpcacheFinder;
use insolita\opcache\contracts\IOpcachePresenter;
use insolita\opcache\utils\Translator;
use yii\helpers\Html;
use yii\web\Controller;

/**
 * Class DefaultController
 *
 * @package backend\modules\opcache\controllers
 */
class DefaultController extends Controller
{
    
    /**
     * @var IOpcachePresenter
     */
    protected $presenter;
    
    /**
     * @var IOpcacheFinder
     */
    protected $finder;
    
    
    public function __construct(
        $id,
        \yii\base\Module $module,
        IOpcacheFinder $finder,
        IOpcachePresenter $presenter,
        array $config = []
    ) {
        $this->presenter = $presenter;
        $this->presenter->setUpFormat();
        $this->finder = $finder;
        parent::__construct($id, $module, $config);
    }
    
    /**
     * @return string
     */
    public function actionIndex()
    {
        $version = $this->finder->getVersion();
        $status = $this->finder->getStatus();
        $presenter = $this->presenter;
        return $this->render('index', compact('version', 'status','presenter'));
    }
    
    /**
     * @return string
     */
    public function actionConfig()
    {
        $version = $this->finder->getVersion();
        $directives = $this->finder->getDirectives();
        $directives = $this->presenter->configDirectivesProvider($directives);
        return $this->render('config', compact('version', 'directives'));
        
    }
    
    /**
     * @return string
     */
    public function actionFiles()
    {
        $version = $this->finder->getVersion();
        $files = $this->finder->getFiles();
        $searchModel = $this->presenter->createFileFilterModel($files);
        $provider = $searchModel->search(\Yii::$app->request->getQueryParams());
        return $this->render('files', compact('version', 'searchModel', 'provider'));
    }
    
    /**
     * @return \yii\web\Response
     */
    public function actionReset()
    {
        if (opcache_reset()) {
            \Yii::$app->session->setFlash('success', Translator::t('cache_reset_success'));
        } else {
            \Yii::$app->session->setFlash('error', Translator::t('cache_reset_fail'));
        }
        return $this->redirect(\Yii::$app->request->getReferrer());
    }
    
    /**
     * @return string
     */
    public function actionBlack()
    {
        $blackList = $this->finder->getBlackList();
        $version = $this->finder->getVersion();
        $blackFile = $this->finder->getDirectives()['opcache.blacklist_filename'];
        return $this->render('blacklist', compact('blackList','blackFile','version'));
    }
    
    /**
     * @param $file
     *
     * @return \yii\web\Response
     */
    public function actionInvalidate($file)
    {
        if (opcache_invalidate($file, true)) {
            \Yii::$app->session->setFlash(
                'success',
                Translator::t('file_invalidate_success') . ' - ' . Html::encode($file)
            );
        } else {
            \Yii::$app->session->setFlash(
                'error',
                Translator::t('file_invalidate_fail') . ' - ' . Html::encode($file)
            );
        }
        return $this->redirect(\Yii::$app->request->getReferrer());
    }
    
    /**
     * @return \yii\web\Response
     */
    public function actionInvalidatePartial()
    {
        $files = $this->finder->getFiles();
        $model = $this->presenter->createFileFilterModel($files);
        $files = $model->filterFiles(\Yii::$app->request->post(null,[]));
        if(!empty($files)){
            foreach ($files as $file){
                opcache_invalidate($file['full_path'], true);
            }
            \Yii::$app->session->setFlash('success', Translator::t('cache_reset_success'));
        }else{
            \Yii::$app->session->setFlash('error', Translator::t('cache_reset_fail'));
        }
        return $this->redirect(['files']);
    }
}
