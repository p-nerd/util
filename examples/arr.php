<?php

require __DIR__ . "/../vendor/autoload.php";

use PNerd\Util\Arr;
use PNerd\Util\Log;

$array = [1, 2, 3, 4, 5];
$arr = new Arr($array);

Log::log("length: ", $arr->length());
Log::log("keys: ", $arr->keys());
Log::log("values: ", $arr->values());
Log::log("exist: ", $arr->exist(5) ? "5 exist" : "5 not exist");
Log::log("find: ", $arr->find(fn ($value) => $value === 4));

Log::log("get: ", $arr->get());
