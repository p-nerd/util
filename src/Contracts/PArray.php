<?php

namespace PNerd\Util\Contracts;

interface PArray
{
    // Basic Array Information
    function length(): int; // 1
    function keys(): array; // 2
    function values(): array; // 3
    function isExist($item): bool; // 4
    function find(callable $callback): mixed; // 5

    // Array Retrieval
    function get(): array; // 6

    // Array Modification
    function merge(array|self $array): self; // 7
    function push($item): self; // 8
    function pop(): self; // 9
    function shift(): self; // 10
    function unshift($item): self; // 11

    // Array Transformation
    function map(callable $callback): self; // 12
    function filter(callable $callback): self; // 13
    function reduce(callable $callback, $initial = null): mixed; // 14

    // Array Utilities
    function reverse(): self; // 15
    function slice(int $startIndex, int $length = null): self; // 16
    function sort(callable $callback = null): self; // 17
    function unique(): self; // 18

    // Set Operations
    function diff(array|self $array): self;  // 19

    // Associative Array Operations
    function combine(array|self $keys): self;  // 20
}
