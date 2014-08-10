# Functional Programming Helpers

## Currying

A curryable function returns a new function when called with less arguments than the curryable function requires.
The new function returned will have the arguments applied, and will also be a curryable function.

This programming pattern can be used to build up more complex functions from less complex functions.

e.g.

```php
use function fp\curry as c;
use function iter\fn\operator as op;

$concat = c(function ($a, $b) { return $a . $b; });

$addTitle = $concat('Mr. ');

echo $addTitle('Spiers');
// Mr. Spiers
```

## Composition

```php
use function fp\compose as co;
$h = co($f, $g);
```
Function composition will return a new function (`$h`) which will first apply the second function (`$g`), pass its
result into the first (`$f`).
