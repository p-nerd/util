<?php

require __DIR__ . "/../src/helpers.php";

use function PNerd\Util\arr;
use function PNerd\Util\fmt;

$array = [1, 2, 3, 4, 5];
$arr = arr($array);


fmt()->println("length: ", $arr->length());
fmt()->println("keys: ", $arr->keys());
fmt()->println("values: ", $arr->values());
fmt()->println("exist: ", $arr->exist(5) ? "5 exist" : "5 not exist");
fmt()->println("find: ", $arr->find(fn ($value) => $value === 4));

fmt()->println("get: ", $arr->get());
