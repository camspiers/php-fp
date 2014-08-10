<?php

namespace fp;

/**
 * Returns a function that can be invoked without all required arguments.
 *
 * Doing so will return a new function with the previous argument applied.
 *
 * @param callable $fn
 * @return \Closure
 */
function curry(callable $fn) {
    $rf = is_array($fn) ? new \ReflectionMethod(...$fn) : new \ReflectionFunction($fn);
    return _curry($fn, [], $rf->getNumberOfRequiredParameters());
}

/**
 * Internal function used for the main currying functionality
 * @param callable $fn
 * @param $appliedArgs
 * @param $requiredParameters
 * @return callable
 */
function _curry(callable $fn, $appliedArgs, $requiredParameters) {
    return function (...$args) use ($fn, $appliedArgs, $requiredParameters) {
        array_push($appliedArgs, ...$args);

        // Get the number of arguments currently applied
        $appliedArgsCount = count($appliedArgs);

        // If we have the required number of arguments call the function
        if ($appliedArgsCount >= $requiredParameters) {
            return $fn(...$appliedArgs);
        // If we will have the required arguments on the next call, return an optimized function
        } elseif ($appliedArgsCount + 1 === $requiredParameters) {
            return bind($fn, $appliedArgs);
        // Return the standard full curry
        } else {
            return _curry($fn, $appliedArgs, $requiredParameters);
        }
    };
}

/**
 * Simple bind function
 * @param callable $fn
 * @param $appliedArgs
 * @return callable
 */
function bind(callable $fn, $appliedArgs) {
    return function (...$args) use ($fn, $appliedArgs) {
        return $fn(...$appliedArgs, ...$args);
    };
}

/**
 * Returns a new function which is a composition the supplied functions
 * @param callable[] ...$fns
 * @return \Closure
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
