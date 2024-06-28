<?php

use PNerd\Util\PArray;


describe('filter', function () {

    it('can filter the array with empty input', function () {
        $array = [];
        $pArray = new PArray($array);

        $result = $pArray->filter(fn ($value, $key) => $value % 2 === 0)->get();

        expect($result)->toBe([]);
    });

    it('can filter the array with all elements being filtered out', function () {
        $array = [1, 3, 5, 7];
        $pArray = new PArray($array);

        $result = $pArray->filter(fn ($value, $key) => $value % 2 === 0)->get();

        expect($result)->toBe([]);
    });

    it('can handle filtering with all elements passing', function () {
        $array = [2, 4, 6, 8];
        $pArray = new PArray($array);

        $result = $pArray->filter(fn ($value, $key) => $value % 2 === 0)->get();

        expect($result)->toBe([2, 4, 6, 8]);
    });

    it('can filter the array with mixed data types', function () {
        $array = [1, "2", 3.0, false, null];
        $pArray = new PArray($array);

        $result = $pArray->filter(fn ($value, $key) => is_int($value))->get();

        expect($result)->toBe([1]);
    });

    it('can handle a large array for filtering', function () {
        $array = range(1, 10000);
        $pArray = new PArray($array);

        $result = $pArray->filter(fn ($value, $key) => $value % 2 === 0)->get();

        expect($result)->toBe(range(2, 10000, 2));
    });

    it('re-indexes the array after filtering', function () {
        $array = [10, 20, 30, 40, 50];
        $pArray = new PArray($array);

        $result = $pArray->filter(fn ($value, $key) => $value > 20)->get();

        expect($result)->toBe([30, 40, 50]);
    });
});

describe('find', function () {

    it('can find an element with empty input', function () {
        $array = [];
        $pArray = new PArray($array);

        $result = $pArray->find(fn ($value, $key) => $value > 3);

        expect($result)->toBeNull();
    });

    it('returns null if no element is found in a non-empty array', function () {
        $array = [1, 2, 3];
        $pArray = new PArray($array);

        $result = $pArray->find(fn ($value, $key) => $value > 3);

        expect($result)->toBeNull();
    });

    it('can find an element when all elements are the same', function () {
        $array = [2, 2, 2, 2];
        $pArray = new PArray($array);

        $result = $pArray->find(fn ($value, $key) => $value === 2);

        expect($result)->toBe(2);
    });

    it('can handle a large array for finding', function () {
        $array = range(1, 10000);
        $pArray = new PArray($array);

        $result = $pArray->find(fn ($value, $key) => $value === 5000);

        expect($result)->toBe(5000);
    });
});
