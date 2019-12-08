<?php
/**
 * Created by PhpStorm.
 * User: Woxapp
 * Date: 28.09.2018
 * Time: 14:10
 */

if (!function_exists('ff')) {
    /**
     * @param $var mixed
     * @param bool $clear_buffer Clear output buffer
     */
    function ff(...$var)
    {
        if(count($var) === 1){
            $var = $var[0];
        }
        Dobrik\ExtendedDumper\Dumper::Dump($var);
    }
}