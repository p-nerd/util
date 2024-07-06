# [util](https://packagist.org/packages/p-nerd/util)

The object oriented wrapper around php functions

## Installation

```sh
composer require p-nerd/util
```

## Usage

### PArray

The `PArray` class provides utility methods for performing operations on arrays in PHP. It includes methods for mapping values, filtering elements, and finding specific elements based on callback functions.

#### Initializing the PArray Object

```php
use PNerd\Util\PArray;

$array = [1, 2, 3, 4, 5];
$pArray = new PArray($array);
```

#### Methods

##### `get()`

Returns the current array.

```php
$array = $pArray->get();
```

##### `length()`

Returns the number of elements in the array.

```php
$length = $pArray->length();
```

##### `map(callable $callback): PArray`

Maps each element in the array to a new value using a callback function.

```php
$pArray->map(function ($value, $key) {
    return $value * 2;
});
```

##### `filter(callable $callback): PArray`

Filters the array using a callback function.

```php
$pArray->filter(function ($value, $key) {
    return $value % 2 == 0;
});
```

##### `find(callable $callback): mixed|null`

Finds the first element in the array that satisfies the callback function.

```php
$foundValue = $pArray->find(function ($value, $key) {
    return $value > 3;
});
```

#### Example

```php
// Example usage
$array = [1, 2, 3, 4, 5];
$pArray = new PArray($array);

// Map example
$pArray->map(function ($value, $key) {
    return $value * 2;
});

// Filter example
$pArray->filter(function ($value, $key) {
    return $value % 2 == 0;
});

// Find example
$foundValue = $pArray->find(function ($value, $key) {
    return $value > 3;
});

echo "Mapped and filtered array: ";
print_r($pArray->get());

echo "First value > 3 found: ";
var_dump($foundValue);
```

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Contact

For questions or feedback, contact [shihab4t@gmail.com](mailto:shihab4t@gmail.com) or visit [developershihab.com](https://developershihab.com).

