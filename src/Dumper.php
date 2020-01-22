<?php

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
            'variable' => $var
        );

        if (is_object($var)) {
            $data = array_merge($data, self::getObjectInfo($var));
        }


        if (!$clear_buffer) {
            VarDumper::dump($data);
        }
        while (ob_get_level()) {
            ob_end_clean();
        }

        exit(VarDumper::dump($data));
    }

    private static function getObjectInfo(object $var)
    {
        $reflection = new \ReflectionClass($var);
        $methods = [];
        /** @var \ReflectionMethod $method */
        foreach ($reflection->getMethods() as $method) {
            $methods[] = sprintf('%s(%s)%s', $method->getName(), self::formatParameters($method->getParameters()), self::getReturnType($method));
        }

        return [
            'class_parent' => get_parent_class($var),
            'class_methods' => $methods
        ];
    }

    private static function formatParameters(array $parameters): string
    {
        $returnArray = [];
        /** @var \ReflectionParameter $parameter */
        foreach ($parameters as $parameter) {
            $tmp = '';

            if ($parameter->hasType()) {
                $returnType = $parameter->getType();
                if($returnType instanceof \ReflectionNamedType){
                    $returnType = $returnType->getName();
                }
                $tmp .= $returnType . ' ';
            }
            $tmp .= '$' . $parameter->getName();

            if ($parameter->isDefaultValueAvailable()) {
                $tmp .= ' = ' . self::formatDefaultParameterValue($parameter->getDefaultValue());
            }
            $returnArray[] = $tmp;
        }
        return implode(', ', $returnArray);
    }

    private static function getReturnType(\ReflectionMethod $method)
    {
        if ($method->hasReturnType()) {
            $returnType = $method->getReturnType();
            if($returnType instanceof \ReflectionNamedType){
                $returnType = $returnType->getName();
            }
            return ': ' . $returnType;
        }

        return '';
    }

    private static function formatDefaultParameterValue($defaultValue)
    {
        if (is_string($defaultValue) || is_numeric($defaultValue)) {
            return $defaultValue;
        }

        return gettype($defaultValue);
    }
}
