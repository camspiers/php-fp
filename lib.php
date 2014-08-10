<?php

namespace fp;

/**
 * @param $fn
 * @return callable
 */
function cached_curry($fn, $name = null) {
    static $cache = [];
    $name = $name ?: $fn;
    if (isset($cache[$name])) {
        return $cache[$name];
    } else {
        return $cache[$name] = curry($fn);
    }
}

/**
 * @param $start
 * @param $args
 * @return callable|mixed
 */
function range($start, ...$args) {
    return cached_curry('iter\range')->__invoke($start, ...$args);
}

/**
 * @param $function
 * @param $args
 * @return callable||array
 */
function map($function, ...$args) {
    return cached_curry('iter\map')->__invoke($function, ...$args);
}

/**
 * @param $function
 * @param $args
 * @return callable|mixed
 */
function mapKeys($function, ...$args) {
    return cached_curry('iter\mapKeys')->__invoke($function, ...$args);
}

/**
 * @param $function
 * @param $args
 * @return callable|mixed
 */
function reindex($function, ...$args) {
    return cached_curry('iter\reindex')->__invoke($function, ...$args);
}

/**
 * @param $predicate
 * @param $args
 * @return callable|mixed
 */
function filter($predicate, ...$args) {
    return cached_curry('iter\filter')->__invoke($predicate, ...$args);
}

/**
 * @param callable $function
 * @param $args
 * @return callable|mixed
 */
function reduce(callable $function, ...$args) {
    return cached_curry('iter\reduce')->__invoke($function, ...$args);
}

/**
 * @param callable $predicate
 * @param $args
 * @return callable|mixed
 */
function any(callable $predicate, ...$args) {
    return cached_curry('iter\any')->__invoke($predicate, ...$args);
}

/**
 * @param callable $predicate
 * @param $args
 * @return callable|mixed
 */
function all(callable $predicate, ...$args) {
    return cached_curry('iter\all')->__invoke($predicate, ...$args);
}

/**
 * @param callable $predicate
 * @param $args
 * @return callable|mixed
 */
function takeWhile(callable $predicate, ...$args) {
    return cached_curry('iter\takeWhile')->__invoke($predicate, ...$args);
}