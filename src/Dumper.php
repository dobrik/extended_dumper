<?php
/**
 * Created by PhpStorm.
 * User: Woxapp
 * Date: 28.09.2018
 * Time: 14:10
 */

namespace Dobrik\ExtendedDumper;

use Symfony\Component\VarDumper\VarDumper;

class Dumper
{

    /**
     * @param $var mixed
     * @param bool $clear_buffer Clear output buffer
     */
    public static function dump($var, bool $clear_buffer = true)
    {
        $trace = debug_backtrace();
        /** First shift correct call from ff function */
        array_shift($trace);
        $lastCall = array_shift($trace);
        $path = str_replace(__DIR__, '', $lastCall['file']);

        $line = $lastCall['line'];

        $data = array(
            'line' => $line,
            'file' => $path,
            'properties' => $var,
            'methods' => get_class_methods($var)
        );

        if (!$clear_buffer) {
            VarDumper::dump($data);
        }
        while (ob_get_level()) {
            ob_end_clean();
        }

        exit(VarDumper::dump($data));
    }
}