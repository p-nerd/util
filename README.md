# [util](https://packagist.org/packages/p-nerd/util)

The object-oriented wrapper around PHP array functions.

## Installation

```sh
composer require p-nerd/util
```

## Example Usage

### PArray 

```php
use PNerd\Util\PArray;

// Example usage of PArray
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

