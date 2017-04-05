<?php
/**
 * Created by solly [06.04.17 6:08]
 */

namespace insolita\opcache\commands;

use insolita\opcache\contracts\IOpcacheFinder;
use insolita\opcache\contracts\IOpcachePresenter;
use yii\console\Controller;

/**
 * Class OpcacheController
 *
 * @package insolita\opcache\commands
 */
class OpcacheController extends Controller
{
    
    /**
     * @var \insolita\opcache\contracts\IOpcacheFinder
     */
    private $finder;
    
    /**
     * @var \insolita\opcache\contracts\IOpcachePresenter
     */
    private $presenter;
    
    /**
     * OpcacheController constructor.
     *
     * @param string                                        $id
     * @param \yii\base\Module                              $module
     * @param \insolita\opcache\contracts\IOpcacheFinder    $finder
     * @param \insolita\opcache\contracts\IOpcachePresenter $presenter
     * @param array                                         $config
     */
    public function __construct(
        $id,
        \yii\base\Module $module,
        IOpcacheFinder $finder,
        IOpcachePresenter $presenter,
        array $config
        = []
    ) {
        $this->finder = $finder;
        $this->presenter = $presenter;
        parent::__construct($id, $module, $config);
    }
    
    /**
     * Show opcache statistic
     */
    public function actionStatus()
    {
        $status = $this->finder->getStatus();
        $this->showCaption('Common Status');
        $this->showRow('opcache_enabled', $this->presenter->formatBool($status->getOpcacheEnabled()));
        $this->showRow('cache_full', $this->presenter->formatBool($status->getCacheFull()));
        $this->showRow('restart_pending', $this->presenter->formatBool($status->getRestartPending()));
        $this->showRow('restart_in_progress', $this->presenter->formatBool($status->getRestartInProgress()));
        $this->showCaption('Memory Usage');
        foreach ($status->getMemoryUsage() as $key => $value) {
            $this->showRow($key, $this->presenter->formatMemory($value, $key));
        }
        $this->showCaption('Interned Strings Usage');
        foreach ($status->getStringsInfo() as $key => $value) {
            $this->showRow($key, $this->presenter->formatMemory($value, $key));
        }
        $this->showCaption('Statistic');
        foreach ($status->getStatistics() as $key => $value) {
            $this->showRow($key, $this->presenter->formatStatistic($value, $key));
        }
    }
    
    /**
     * Show opcache config
     */
    public function actionConfig()
    {
        $config = $this->finder->getDirectives();
        foreach ($config as $key => $value) {
            $this->showRow($key, $value);
        }
    }
    
    /**
     * List of cached file; Use with pipe grep for filtering
     * @example opcache/files | grep yii2
     */
    public function actionFiles()
    {
        $files = $this->finder->getFiles();
        foreach ($files as $row) {
            $this->stdout($row['full_path'] . PHP_EOL);
        }
    }
    
    /**
     * List of black-listed files and patterns
     */
    public function actionBlack()
    {
        $files = $this->finder->getBlackList();
        foreach ($files as $file) {
            $this->stdout($file . PHP_EOL);
        }
    }
    /**
     * Reset cache
     * @return int
     */
    public function actionReset()
    {
        if (opcache_reset()) {
            return 0;
        } else {
            return 1;
        }
    }
    
    /**
     * Invalidate file
     * @param $file
     *
     * @return int
     */
    public function actionInvalidate($file)
    {
        if (opcache_invalidate($file, true)) {
            return 0;
        } else {
            return 1;
        }
    }
    
    /**
     * @param $key
     * @param $value
     */
    private function showRow($key, $value)
    {
        $this->stdout($key . ' - ' . $value . PHP_EOL);
    }
    
    /**
     * @param $value
     */
    private function showCaption($value)
    {
        $this->stdout(str_repeat('=', 10) . ' ' . $value . ' ' . str_repeat('=', 10) . PHP_EOL);
    }
}
