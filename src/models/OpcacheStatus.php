<?php
/**
 * Created by solly [05.04.17 19:33]
 */

namespace insolita\opcache\models;

use insolita\opcache\utils\Helper;

/**
 * Class OpcacheStatus
 *
 * @package insolita\opcache\models
 */
class OpcacheStatus
{
    /**
     * @var bool
     */
    private $opcacheEnabled=false;
    
    /**
     * @var bool
     */
    private $cacheFull=false;
    
    /**
     * @var bool
     */
    private $restartPending=false;
    
    /**
     * @var bool
     */
    private $restartInProgress=false;
    
    /**
     * @var array
     */
    private $memoryUsage=[];
    
    /**
     * @var array
     */
    private $statistics=[];
    
    /**
     * @var array
     */
    private $stringsInfo=[];
    
    /**
     * OpcacheStatus constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->memoryUsage = Helper::remove($config, 'memory_usage');
        $this->statistics =  Helper::remove($config, 'opcache_statistics');
        $this->stringsInfo = Helper::remove($config, 'interned_strings_usage');
        foreach ($config as $name => $value) {
            $name = Helper::variablize($name);
            if(isset($this->$name)){
                $this->$name = $value;
            }
        }
    }
    
    /**
     * @return bool
     */
    public function getOpcacheEnabled()
    {
        return $this->opcacheEnabled;
    }
    
    /**
     * @return bool
     */
    public function getCacheFull()
    {
        return $this->cacheFull;
    }
    
    /**
     * @return bool
     */
    public function getRestartPending()
    {
        return $this->restartPending;
    }
    
    /**
     * @return bool
     */
    public function getRestartInProgress()
    {
        return $this->restartInProgress;
    }
    
    /**
     * @return array
     */
    public function getMemoryUsage()
    {
        return $this->memoryUsage;
    }
    
    /**
     * @return array
     */
    public function getStatistics()
    {
        return $this->statistics;
    }
    
    /**
     * @return array
     */
    public function getStringsInfo()
    {
        return $this->stringsInfo;
    }
    
    
}
