<?php

namespace FP;

/**
 * Returns a function that can be invoked without all arguments.
 * 
 * Doing so will return a new function with the previous argument applied.
 * 
 * @param callable $fn
 * @param array $appliedArgs
 * @param int|void $parameterNumber
 * @return callable
 */
function curry(callable $fn, $appliedArgs = [], $parameterNumber = null) {
    if (is_null($parameterNumber)) {
        $rf = is_array($fn) ? new \ReflectionMethod(...$fn) : new \ReflectionFunction($fn);
        $parameterNumber = $rf->getNumberOfRequiredParameters();
    }

    return function (...$args) use ($fn, $appliedArgs, $parameterNumber) {
        array_push($appliedArgs, ...$args);

        if (count($appliedArgs) >= $parameterNumber) {
            return $fn(...$appliedArgs);
        }

        return curry($fn, $appliedArgs, $parameterNumber);
    };
}

/**
 * Returns a new function which is a composition the supplied functions
 * @param callable[] ...$fns
 * @return callable
 */
function compose(...$fns) {
    /** @var callable $prev */
    $prev = array_shift($fns);

    foreach ($fns as $fn) {
        $prev = function (...$args) use ($fn, $prev) {
            return $prev($fn(...$args));
        };
    }

    return $prev;
}
