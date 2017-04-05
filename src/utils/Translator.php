<?php
/**
 * Created by solly [05.04.17 17:58]
 */

namespace insolita\opcache\utils;

/**
 * Class Translator
 *
 * @package backend\modules\opcache\utils
 */
class Translator
{
    /**
     * @param       $message
     * @param array $params
     * @param null  $language
     *
     * @return string
     */
    public static function hint($message, $params = [], $language = null)
    {
        return \Yii::t('opcache/hint', $message, $params, $language);
    }
    /**
     * @param       $message
     * @param array $params
     * @param null  $language
     *
     * @return string
     */
    public static function status($message, $params = [], $language = null)
    {
        return \Yii::t('opcache/status', $message, $params, $language);
    }
    /**
     * @param       $message
     * @param array $params
     * @param null  $language
     *
     * @return string
     */
    public static function t($message, $params = [], $language = null)
    {
        return \Yii::t('opcache/interface', $message, $params, $language);
    }
}
