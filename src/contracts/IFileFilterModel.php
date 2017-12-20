<?php
/**
 * Created by solly [06.04.17 3:36]
 */

namespace insolita\opcache\contracts;

use yii\data\ArrayDataProvider;

/**
 * Interface IFileFilterModel
 *
 * @package insolita\opcache\contracts
 */
interface IFileFilterModel
{
    /**
     * @param array $params
     *
     * @return ArrayDataProvider
     */
    public function search(array $params = []);
    
    /**
     * @param array $params
     *
     * @return array
     */
    public function filterFiles(array $params = []);
}
