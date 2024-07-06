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
     * Returns the current array.
     *
     * @return array The current array.
     */
    public function get(): array
    {
        return $this->array;
    }

    /**
     * Returns the length of the array.
     *
     * @return int The number of elements in the array.
     */
    public function length(): int
    {
        return count($this->array);
    }

    /**
     * Maps each element in the array to a new value using a callback function.
     *
     * The callback function receives two parameters: the element's value and its key.
     * It should return the transformed value for each element.
     *
     * @param callable $callback The callback function to apply to each element.
     * @return $this The current instance of PArray, with mapped values.
     */
    public function map(callable $callback): self
    {
        $this->array = array_map(
            fn ($value, $key) => $callback($value, $key),
            $this->array,
            array_keys($this->array)  // Include keys for array_map
        );
        return $this;
    }

    /**
     * Filters the array using a callback function.
     *
     * The callback function should take two parameters: the element's value and its key.
     * It should return true to keep the element in the array, or false to remove it.
     * After filtering, the keys of the array are re-indexed sequentially.
     *
     * @param callable $callback The callback function used to filter elements.
     * @return $this The current instance of PArray, with filtered elements.
     */
    public function filter(callable $callback): self
    {
        $this->array = array_filter(
            $this->array,
            fn ($value, $key) => $callback($value, $key),
            ARRAY_FILTER_USE_BOTH
        );

        // Re-index the array sequentially
        $this->array = array_values($this->array);

        return $this;
    }

    /**
     * Finds the first element in the array that satisfies the callback function.
     *
     * The callback function should take two parameters: the element's value and its key.
     * It should return true to indicate the element is found, or false otherwise.
     *
     * @param callable $callback The callback function used to find an element.
     * @return mixed|null The first element found that satisfies the callback, or null if none found.
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
}
