<?php

use PNerd\Util\PArray;

describe('filter', function () {
    it('can filter the array', function ($array, $callback, $expected) {
        $pArray = new PArray($array);

        $result = $pArray->filter($callback)->get();

        expect($result)->toBe($expected);
    })->with([
        'empty input' => [[], fn ($value) => $value % 2 === 0, []],
        'all elements filtered out' => [[1, 3, 5, 7], fn ($value) => $value % 2 === 0, []],
        'all elements passing' => [[2, 4, 6, 8], fn ($value) => $value % 2 === 0, [2, 4, 6, 8]],
        'mixed data types' => [[1, "2", 3.0, false, null], fn ($value) => is_int($value), [1]],
        'large array' => [range(1, 10000), fn ($value) => $value % 2 === 0, range(2, 10000, 2)],
        're-indexed array' => [[10, 20, 30, 40, 50], fn ($value) => $value > 20, [30, 40, 50]],
    ]);

    it('can filter the array with correct index', function () {
        $array = [10, 20, 30, 40, 50];
        $pArray = new PArray($array);
        $result = $pArray->filter(fn ($value) => $value > 20)->get();
        $keys = array_keys($result);
        expect($keys)->toBe([0, 1, 2]);
    });
});

describe('find', function () {

    it('can find an element', function ($array, $callback, $expected) {
        $pArray = new PArray($array);

        $result = $pArray->find($callback);

        expect($result)->toBe($expected);
    })->with([
        'empty input' => [[], fn ($value, $key) => $value > 3, null],
        'no element found' => [[1, 2, 3], fn ($value, $key) => $value > 3, null],
        'all elements same' => [[2, 2, 2, 2], fn ($value, $key) => $value === 2, 2],
        'large array' => [range(1, 10000), fn ($value, $key) => $value === 5000, 5000],
    ]);
});
