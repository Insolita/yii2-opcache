<?php
/**
 * Created by solly [05.04.17 19:55]
 */

namespace insolita\opcache\models;

use insolita\opcache\contracts\IFileFilterModel;
use insolita\opcache\utils\Translator;
use yii\base\Model;
use yii\data\ArrayDataProvider;

/**
 * Class FileFilterModel
 *
 * @package insolita\opcache\models
 */
class FileFilterModel extends Model implements IFileFilterModel
{
    /**
     * @var
     */
    public $full_path;
    
    /**
     * @var
     */
    private $files;
    
    /**
     * FileFilterModel constructor.
     *
     * @param array $files
     * @param array $config
     */
    public function __construct(array &$files, array $config = [])
    {
        $this->files = $files;
        parent::__construct($config);
    }
    
    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['full_path'], 'trim'],
            [['full_path'], 'string', 'max' => 100],
        ];
    }
    
    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'full_path' => Translator::t('full_path'),
        ];
    }
    
    /**
     * @param $params
     *
     * @return \yii\data\ArrayDataProvider
     */
    public function search(array $params = [])
    {
        $provider = new ArrayDataProvider(
            [
                'allModels' => $this->files,
                'key' => 'full_path',
                'pagination' => ['pageSize' => 100],
                'sort' => [
                    'attributes' => [
                        'full_path' => [],
                        'timestamp' => [],
                        'hits' => [],
                        'memory_consumption' => [],
                        'last_used_timestamp' => [],
                    ],
                    'defaultOrder' => ['full_path' => SORT_ASC],
                ],
            ]
        );
        if ($this->load($params) && $this->validate() && !empty($this->full_path)) {
            $provider = new ArrayDataProvider(
                [
                    'allModels' => array_filter($this->files, [$this, 'pathFilter']),
                    'key' => 'full_path',
                    'pagination' => ['pageSize' => 100],
                    'sort' => [
                        'attributes' => [
                            'full_path' => [],
                            'timestamp' => [],
                            'hits' => [],
                            'memory_consumption' => [],
                            'last_used_timestamp' => [],
                        ],
                        'defaultOrder' => ['full_path' => SORT_ASC],
                    ],
                ]
            );
        }
        return $provider;
    }
    
    /**
     * @param $params
     *
     * @return array
     */
    public function filterFiles(array $params = [])
    {
        if ($this->load($params) && $this->validate() && !empty($this->full_path)) {
            return array_filter($this->files, [$this, 'pathFilter']);
        } else {
            return [];
        }
    }
    
    /**
     * @param $item
     *
     * @return bool
     */
    protected function pathFilter($item)
    {
        if (mb_strpos($item['full_path'], $this->full_path) !== false) {
            return true;
        } else {
            return false;
        }
    }
}
