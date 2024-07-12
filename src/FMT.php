<?php

namespace PNerd\Util;

/**
 * Provides utility functions for formatting output to stdout.
 */
class FMT
{
    /**
     * Prints each element of the given array(s).
     *
     * This method accepts a variable number of arguments. If an argument is an array,
     * it prints each element of that array separated by a space. Otherwise, it prints
     * the argument directly.
     *
     * @param mixed ...$array A variable number of arguments, which can be individual
     *                        elements or arrays of elements to be printed.
     */
    public static function print(...$array)
    {
        foreach ($array as $item) {
            if (is_array($item)) {
                foreach ($item as $subItem) {
                    echo $subItem . " ";
                }
            } else {
                echo $item;
            }
        }
    }

    /**
     * Prints each element of the given array(s) followed by a newline.
     *
     * This method accepts a variable number of arguments. If an argument is an array,
     * it prints each element of that array separated by a space. Otherwise, it prints
     * the argument directly. After printing all arguments, it outputs a newline character.
     *
     * @param mixed ...$array A variable number of arguments, which can be individual
     *                        elements or arrays of elements to be printed.
     */
    public static function println(...$array)
    {
        static::print(...$array);
        echo PHP_EOL;
    }
}
