<?php
/**
 * Created by solly [06.04.17 3:23]
 */

namespace insolita\opcache\contracts;

use yii\data\ArrayDataProvider;

/**
 * Class IOpcachePresenter
 *
 * @package backend\modules\opcache\services
 */
interface IOpcachePresenter
{
    
    /**
     * @return mixed
     */
    public function setUpFormat();
    /**
     * @param array $directives
     *
     * @return mixed
     */
    public function configDirectivesProvider(array &$directives);
    
    /**
     * @param array $files
     *
     * @return \insolita\opcache\contracts\IFileFilterModel|\yii\base\Model
     */
    public function createFileFilterModel(array &$files);
    
    /**
     * @param $value
     * @param $key
     *
     * @return string
     */
    public function formatStatistic($value, $key);
    
    /**
     * @param $value
     * @param $key
     *
     * @return string
     */
    public function formatMemory($value, $key);
    
    /**
     * @param $value
     *
     * @return string
     */
    public function formatBool($value);
}