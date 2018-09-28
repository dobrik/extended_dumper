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
    function ff($var, bool $clear_buffer = true)
    {
        Dobrik\ExtendedDumper\Dumper::Dump($var, $clear_buffer);
    }
}