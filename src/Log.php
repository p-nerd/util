<?php

namespace PNerd\Util;

class Log
{
    public static function log(...$array)
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

        echo PHP_EOL;
    }
}
