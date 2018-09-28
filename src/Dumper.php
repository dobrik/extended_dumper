<?php
/**
 * Created by PhpStorm.
 * User: Woxapp
 * Date: 28.09.2018
 * Time: 14:10
 */


use Symfony\Component\VarDumper\VarDumper;

namespace Dobrik\ExtendedDumper;

class Dumper
{
    /**
     *
     * Clear output buffer
     *
     * @var bool
     */
    private static $clear = true;

    /**
     * @param $var mixed
     */
    public static function Dump($var)
    {
        $trace = debug_backtrace();
        $lastCall = array_shift($trace);
        $path = str_replace(__DIR__, '', $lastCall['file']);

        $line = $lastCall['line'];

        $data = array(
            'line' => $line,
            'file' => $path,
            'properties' => $var,
            'methods' => get_class_methods($var)
        );

        if (!self::$clear) {
            VarDumper::dump($data);
        }
        while (ob_get_level()) {
            ob_end_clean();
        }

        exit(VarDumper::dump($data));
    }
}