<?php

namespace PNerd\Util;

use PNerd\Util\Contracts\Arr as ContractsArr;

/**
 * A utility class for performing operations on arrays.
 */
class Arr implements ContractsArr
{
    /**
     * @var array The array to be operated on.
     */
    protected array $array;

    /**
     * Constructor.
     *
     * @param array $array The array to be used in the operations.
     */
    public function __construct(array $array)
    {
        $this->array = $array;
    }

    /**
     * Returns the length of the array.
     */
    public function length(): int
    {
        return count($this->array);
    }

    /**
     * Returns all the keys of the array.
     */
    public function keys(): array
    {
        return array_keys($this->array);
    }

    /**
     * Returns all the values of the array.
     */
    public function values(): array
    {
        return array_values($this->array);
    }

    /**
     * Checks if a value exists in the array.
     */
    public function exist($item): bool
    {
        return in_array($item, $this->array);
    }

    /**
     * Returns the current array.
     */
    public function get(): array
    {
        return $this->array;
    }

    /**
     * Finds the first element in the array that satisfies the callback function.
     *
     * The callback function should take two parameters: the element's value and its key.
     * It should return true to indicate the element is found, or false otherwise.
     */
    public function find(callable $callback): mixed
    {
        foreach ($this->array as $key => $value) {
            if ($callback($value, $key)) {
                return $value;
            }
        }
        return null;
    }



    /**
     * Merges the current array with another array or PArray object.
     *
     * @param array|self $array The array or PArray object to merge with.
     * @return $this The current instance of PArray, with merged arrays.
     */
    public function merge($array): self
    {
        $this->array = array_merge($this->array, $this->returnArray($array));
        return $this;
    }

    /**
     * Adds an element to the end of the array.
     */
    public function push($item): self
    {
        array_push($this->array, $item);
        return $this;
    }

    /**
     * Removes the last element of the array.
     */
    public function pop(): self
    {
        array_pop($this->array);
        return $this;
    }

    /**
     * Removes the first element of the array.
     */
    public function shift(): self
    {
        array_shift($this->array);
        return $this;
    }

    /**
     * Adds an element to the beginning of the array.
     */
    public function unshift($item): self
    {
        array_unshift($this->array, $item);
        return $this;
    }

    /**
     * Maps each element in the array to a new value using a callback function.
     *
     * The callback function receives two parameters: the element's value and its key.
     * It should return the transformed value for each element.
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
     * Reduces the array to a single value using a callback function.
     *
     * @param callable $callback The callback function to apply to each element in the array.
     *                           It should accept two parameters:
     *                           - mixed $carry: Holds the return value of the previous callback invocation,
     *                             or $initial if it's the first iteration.
     *                           - mixed $item: The current array element.
     * @param mixed $initial (Optional) The initial value to carry through the reduction.
     *                        If omitted, the reduction starts from the first element of the array.
     * @return mixed The single value that results from applying the callback function iteratively
     *               to the array elements.
     */
    public function reduce(callable $callback, $initial = null): mixed
    {
        return array_reduce($this->array, $callback, $initial);
    }

    /**
     * Reverses the order of elements in the array.
     */
    public function reverse(): self
    {
        $this->array = array_reverse($this->array);
        return $this;
    }

    /**
     * Extracts a slice of the array.
     *
     * @param int $startIndex The start index of the slice.
     * @param int|null $length Optional length of the slice.
     */
    public function slice(int $startIndex, int $length = null): self
    {
        $this->array = array_slice($this->array, $startIndex, $length);
        return $this;
    }

    /**
     * Sorts the elements of the array using a callback function for associative arrays.
     * Uses standard sort function for indexed arrays.
     *
     * @param callable|null $callback (Optional) The callback function used for custom sorting of associative arrays.
     *                               The callback should accept two parameters representing array elements:
     *                               - mixed $valueA: The value of the first array element.
     *                               - mixed $valueB: The value of the second array element.
     *                               The function should return an integer less than, equal to, or greater than zero
     *                               if the first argument is considered to be respectively less than, equal to,
     *                               or greater than the second.
     *                               If null, indexed arrays will be sorted in ascending order and associative
     *                               arrays will retain key associations.
     */
    public function sort(callable $callback = null): self
    {
        if ($callback !== null) {
            uasort($this->array, $callback); // Using uasort for associative arrays
        } else {
            sort($this->array); // Using sort for indexed arrays
        }
        return $this;
    }

    /**
     * Removes duplicate values from the array.
     */
    public function unique(): self
    {
        $this->array = array_unique($this->array);
        return $this;
    }

    /**
     * Computes the difference between the current array and another array or PArray object.
     *
     * @param array|self $array The array or PArray object containing keys.
     */
    public function diff($array): self
    {
        $this->array = array_diff($this->array, $this->returnArray($array));
        return $this;
    }

    /**
     * Combines the current array with keys provided from another array or PArray object.
     *
     * @param array|self $keys The array or PArray object containing keys.
     */
    public function combine($keys): self
    {
        $this->array = array_combine($this->returnArray($keys), $this->array);

        return $this;
    }

    /**
     * Helper function to retrieve the underlying array from a PArray object.
     *
     * @param mixed $array Either an array or an instance of PArray.
     * @return array The underlying array.
     */
    protected function returnArray($array): array
    {
        if ($array instanceof self) {
            $array = $array->get();
        }
        return $array;
    }
}
