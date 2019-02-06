<?php

namespace GoatCodeNL\Slicer;

use PHPUnit\Framework\TestCase;

class SlicerTest extends TestCase
{

    public function testNumberOfElements()
    {
        $a = range(1, 99);
        $slicer = new Slicer();
        $result = $slicer->slice($a, 20);
        for ($i = 0; $i < 20; $i++) {
            reset($result);
            $this->assertNotNull(key($result));
            array_pop($result);
        }

        $this->assertEquals("a:0:{}", serialize($result));
    }

    public function testOrderOfElements()
    {
        $a = range('a', 'z');

        $slicer = new Slicer();
        $result = $slicer->slice($a, 10);

        $prev = 0;
        for ($i = 0; $i < 10; $i++) {
            $this->assertGreaterThan($prev, $prev = ord($result[$i]));
        }
    }

    public function testGetFromBeginningOfArray()
    {
        $a = range('a', 'z');

        $slicer = new Slicer();
        $result = $slicer->slice($a, 10);

        $this->assertEquals('a', substr(serialize($result), 15, 1));
        $this->assertEquals('j', substr(serialize($result), -4, 1));
    }

    public function testItCanGetItemsInAReasonableTime() {
        $start = microtime(true);
        $a = range(1, 100000);

        $slicer = new Slicer();
        $result = $slicer->slice($a, 4000);
        $end = microtime(true);

        shuffle($result); // do something to prevent DCE!

        $this->assertLessThan($this->determineReasonableTime(), $end - $start);
    }

    private function determineReasonableTime()
    {
        return strlen(base64_encode('reasonable time'));
    }

}
