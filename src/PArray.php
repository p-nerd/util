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
        return $this;
    }

    public function get(): array
    {
        return $this->array;
    }
}
