# Functional Programming Helpers

## Currying

A curryable function returns a new function when called with less arguments than the curryable function requires.
The new function returned will have the arguments applied, and will also be a curryable function.

This programming pattern can be used to build up more complex functions from less complex functions.

e.g.

```php
use function fp\curry as c;

// Create a curryable function
$concat = c(function ($a, $b) { return $a . $b; });

// Create a new function with 'Mr. ' applied
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

## Usage

### Turning normal functions into curryable functions

```php
$map = fp\curry('array_map');
```

### Create non-closure functions that are curryable

```php
function _tag($tag, $text) {
    return "<$tag>$text</$tag>";
}

function tag(...$args) {
    return fp\curry('_tag')->__invoke(...$args);
}

// We now have a paragraph function
$p = tag('p');

// We now have a div function
$div = tag('div');

echo $div($p("Some text"));
// <div><p>Some text</p></div>
```