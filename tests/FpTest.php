<?php

namespace fp;

class FpTest extends \PHPUnit_Framework_TestCase
{
    public function testCurryReturnsClosure()
    {
        $fn = $this->getCurriedFunction();

        $this->assertInstanceOf('Closure', $fn);
        
        return $fn;
    }

    /**
     * @depends testCurryReturnsClosure
     */
    public function testCurryFullApplicationReturnsValue($fn)
    {
        $this->assertEquals(3, $fn(1, 2));
    }

    /**
     * @depends testCurryReturnsClosure
     */
    public function testCurryPartialApplicationReturnsClosure($fn)
    {
        $fn = $fn(1);

        $this->assertInstanceOf('Closure', $fn);
        
        return $fn;
    }

    /**
     * @depends testCurryPartialApplicationReturnsClosure
     */
    public function testCurryPartialToFullApplicationReturnsValue($fn)
    {
        $this->assertEquals(3, $fn(2));
    }

    /**
     * @return callable
     */
    protected function getCurriedFunction()
    {
        return curry(function ($a, $b) {
            return $a + $b;
        });
    }
}