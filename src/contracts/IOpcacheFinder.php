<?php
/**
 * Created by solly [06.04.17 3:54]
 */

namespace insolita\opcache\contracts;

/**
 * Interface IOpcacheFinder
 *
 * @package insolita\opcache\contracts
 */
interface IOpcacheFinder
{
    /**
     * @return array
     */
    public function getDirectives();
    
    /**
     * @return string
     */
    public function getVersion();
    
    /**
     * @return array
     */
    public function getBlackList();
    
    /**
     * @return array
     */
    public function getFiles();
    
    /**
     * @return \insolita\opcache\models\OpcacheStatus
     */
    public function getStatus();
}
