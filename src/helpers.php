<?php

require __DIR__ . "/../vendor/autoload.php";

namespace PNerd\Util;


function arr(array $array): Arr
{
    return new Arr($array);
}

function fmt(): FMT
{
    return new FMT();
}
