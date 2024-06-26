<?php

namespace PNerd\Util;

class PArray
{
    public function __construct(
        protected array $array
    ) {
        //
    }

    public function filter(callable $callback): self
    {
        $this->array =  array_filter(
            $this->array,
            fn ($value, $key) => $callback($value, $key),
            ARRAY_FILTER_USE_BOTH
        );
        $array = [];
        foreach ($this->array as $key => $value) {
            $array[] = $value;
        }
        $this->array = $array;
        return $this;
    }

    public function find(callable $callback)
    {
        foreach ($this->array as $key => $value) {
            if ($callback($value, $key)) {
                return $value;
            }
        }
        return null;
    }

    public function get(): array
    {
        return $this->array;
    }
}
