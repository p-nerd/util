<?php

require __DIR__ . "/../src/PArray.php";

use PNerd\Util\PArray;

// Example usage of PArray
$array = [1, 2, 3, 4, 5];
$pArray = new PArray($array);

$pArray
    // Map example
    ->map(function ($value, $key) {
        return $value * 2;
    })
    // Filter example
    ->filter(function ($value, $key) {
        return $value % 2 == 0;
    });

// Output results after filtering
echo "Mapped and filtered array: ";
print_r($pArray->get());

// Find example after filtering
$foundValue = $pArray->find(function ($value, $key) {
    return $value > 3;
});

// Output result of find operation
echo "First value > 3 found: $foundValue ";
