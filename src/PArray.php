<?php

namespace PNerd\Util;

/**
 * Class PArray
 *
 * A utility class for performing operations on arrays.
 */
class PArray
{
    /**
     * @var array The array to be operated on.
     */
    protected array $array;

    /**
     * PArray constructor.
     *
     * @param array $array The array to be used in the operations.
     */
    public function __construct(array $array)
    {
        $this->array = $array;
    }

    /**
     * Filters the array using a callback function.
     *
     * The callback function should take two parameters: the value and the key of each element in the array.
     * The callback should return true to keep the element in the array, or false to remove it.
     * After filtering, the keys are re-indexed.
     *
     * @param callable $callback The callback function to use for filtering.
     * @return $this The current instance for method chaining.
     */
    public function filter(callable $callback): self
    {
        $this->array = array_filter(
            $this->array,
            fn ($value, $key) => $callback($value, $key),
            ARRAY_FILTER_USE_BOTH
        );

        // Re-index the array
        $array = [];
        foreach ($this->array as $key => $value) {
            $array[] = $value;
        }
        $this->array = $array;

        return $this;
    }

    /**
     * Finds the first element in the array that satisfies the callback function.
     *
     * The callback function should take two parameters: the value and the key of each element in the array.
     * The callback should return true to find the element, or false to continue searching.
     *
     * @param callable $callback The callback function to use for finding an element.
     * @return mixed|null The first element that satisfies the callback, or null if no element is found.
     */
    public function find(callable $callback)
    {
        foreach ($this->array as $key => $value) {
            if ($callback($value, $key)) {
                return $value;
            }
        }
        return null;
    }

    /**
     * Returns the array.
     *
     * @return array The filtered array.
     */
    public function get(): array
    {
        return $this->array;
    }
}
