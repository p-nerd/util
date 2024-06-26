<?php

class PArray
{
    public function filter(array $array, callable $callback)
    {
        return array_filter($array, fn ($value, $key) => $callback($value, $key), ARRAY_FILTER_USE_BOTH);
    }
}
