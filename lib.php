<?php

namespace fp;

/**
 * @param $fn
 * @return \Closure
 */
function _cached_curry($fn) {
    static $cache = [];
    if (isset($cache[$fn])) {
        return $cache[$fn];
    } else {
        return $cache[$fn] = curry($fn);
    }
}

/**
 * @param $fn
 * @param $args
 * @return mixed
 */
function _call_cached_curry($fn, ...$args) {
    return _cached_curry($fn)->__invoke(...$args);
}

/**
 * @param $start
 * @param $args
 * @return callable|mixed
 */
function range($start, ...$args) {
    return _call_cached_curry('iter\range', $start, ...$args);
}

/**
 * @param $function
 * @param $args
 * @return callable||array
 */
function map($function, ...$args) {
    return _call_cached_curry('iter\map', $function, ...$args);
}

/**
 * @param $function
 * @param $args
 * @return callable|mixed
 */
function mapKeys($function, ...$args) {
    return _call_cached_curry('iter\mapKeys', $function, ...$args);
}

/**
 * @param $function
 * @param $args
 * @return callable|mixed
 */
function reindex($function, ...$args) {
    return _call_cached_curry('iter\reindex', $function, ...$args);
}

/**
 * @param $predicate
 * @param $args
 * @return callable|mixed
 */
function filter($predicate, ...$args) {
    return _call_cached_curry('iter\filter', $predicate, ...$args);
}

/**
 * @param callable $function
 * @param $args
 * @return callable|mixed
 */
function reduce(callable $function, ...$args) {
    return _call_cached_curry('iter\reduce', $function, ...$args);
}

/**
 * @param callable $predicate
 * @param $args
 * @return callable|mixed
 */
function any(callable $predicate, ...$args) {
    return _call_cached_curry('iter\any')->__invoke($predicate, ...$args);
}

/**
 * @param callable $predicate
 * @param $args
 * @return callable|mixed
 */
function all(callable $predicate, ...$args) {
    return _call_cached_curry('iter\all', $predicate, ...$args);
}

/**
 * @param callable $predicate
 * @param $args
 * @return callable|mixed
 */
function takeWhile(callable $predicate, ...$args) {
    return _call_cached_curry('iter\takeWhile', $predicate, ...$args);
}

/**
 * @param callable $predicate
 * @param $args
 * @return callable|mixed
 */
function dropWhile(callable $predicate, ...$args) {
    return _call_cached_curry('iter\dropWhile', $predicate, ...$args);
}

/**
 * @param $separator
 * @param $args
 * @return callable|mixed
 */
function join($separator, ...$args) {
    return _call_cached_curry('iter/join', $separator, ...$args);
}