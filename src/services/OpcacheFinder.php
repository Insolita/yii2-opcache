<?php
/**
 * Created by solly [05.04.17 17:55]
 */

namespace insolita\opcache\services;

use insolita\opcache\contracts\IOpcacheFinder;
use insolita\opcache\models\OpcacheStatus;
use insolita\opcache\utils\OpcacheException;
use insolita\opcache\utils\Helper;

/**
 * Class OpcacheFinder
 *
 * @package insolita\opcache\services
 */
class OpcacheFinder implements IOpcacheFinder
{
    /**
     * @var array
     */
    private $directives = [];
    
    /**
     * @var string
     */
    private $version = 'Unknown';
    
    /**
     * @var array
     */
    private $blackList = [];
    
    /**
     * @var array
     */
    private $files = [];
    
    /**
     * @var \insolita\opcache\models\OpcacheStatus
     */
    private $status;
    
    /**
     * OpcacheFinder constructor.
     *
     * @throws \insolita\opcache\utils\OpcacheException
     */
    public function __construct()
    {
        try {
            $config = opcache_get_configuration();
            $this->directives = Helper::remove($config, 'directives', []);
            $this->blackList = Helper::remove($config, 'blacklist', []);
            $this->version = Helper::getValue($config, 'version.opcache_product_name', '')
                . Helper::getValue($config, 'version.version', 'Unknown');
            $status = opcache_get_status(true);
            $this->files = Helper::remove($status, 'scripts', []);
            $this->status = new OpcacheStatus($status);
            unset($config, $status);
        } catch (\Throwable $e) {
            throw new OpcacheException(
                'Opcache functions not available;
             Check if extension opcache installed; Check opcache.restriction_api option'
            );
        }
    }
    
    /**
     * @return array
     */
    public function getDirectives()
    {
        return $this->directives;
    }
    
    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }
    
    /**
     * @return array
     */
    public function getBlackList()
    {
        return $this->blackList?$this->blackList:[];
    }
    
    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files ? array_values($this->files) : [];
    }
    
    /**
     * @return \insolita\opcache\models\OpcacheStatus
     */
    public function getStatus()
    {
        return $this->status;
    }
    
}
