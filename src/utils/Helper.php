<?php
/**
 * Created by solly [05.04.17 19:17]
 */

namespace insolita\opcache\utils;


/**
 * Class Helper
 *
 * @package insolita\opcache\utils
 */
class Helper
{
    /**
     * @param      $array
     * @param      $key
     * @param null $default
     *
     * @return mixed|null
     */
    public static function getValue($array, $key, $default = null)
    {
        if ($key instanceof \Closure) {
            return $key($array, $default);
        }
        
        if (is_array($key)) {
            $lastKey = array_pop($key);
            foreach ($key as $keyPart) {
                $array = static::getValue($array, $keyPart);
            }
            $key = $lastKey;
        }
        
        if (is_array($array) && (isset($array[$key]) || array_key_exists($key, $array))) {
            return $array[$key];
        }
        
        if (($pos = strrpos($key, '.')) !== false) {
            $array = static::getValue($array, substr($key, 0, $pos), $default);
            $key = substr($key, $pos + 1);
        }
        
        if (is_object($array)) {
            // this is expected to fail if the property does not exist, or __get() is not implemented
            // it is not reliably possible to check whether a property is accessible beforehand
            return $array->$key;
        } elseif (is_array($array)) {
            return (isset($array[$key]) || array_key_exists($key, $array)) ? $array[$key] : $default;
        } else {
            return $default;
        }
    }
    
    /**
     * @param      $array
     * @param      $key
     * @param null $default
     *
     * @return mixed|null
     */
    public static function remove(&$array, $key, $default = null)
    {
        if (is_array($array) && (isset($array[$key]) || array_key_exists($key, $array))) {
            $value = $array[$key];
            unset($array[$key]);
            
            return $value;
        }
        
        return $default;
    }
    
    /**
     * Converts a word like "send_email" to "sendEmail".
     *
     * @param string $word to lowerCamelCase
     *
     * @return string
     */
    public static function variablize($word)
    {
        $word = str_replace(
            ' ',
            '',
            ucwords(preg_replace('/[^A-Za-z0-9]+/', ' ', $word))
        );
        
        return strtolower($word[0]) . substr($word, 1);
    }
}
