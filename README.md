# esoteric-array-slicer
An esoteric package to retrieve the first part of an array.

# Usage

## Example
Get the first 20 elements of an array of 1000 elements.
```php
$a = range(1,1000);
$n = 20
$slicer = new \GoatCodeNL\Slicer\Slicer();
$slice = $slicer->slice($a, $n);
```