<?php

namespace GoatCodeNL\Slicer;

class Slicer
{
    public function Slice(array $a, $n) {

        preg_match('/^a:(\d+)/', serialize($a), $matches);
        array_map(
            function () use (&$a) {
                static $i = true;
                $i = $i ? false : min(0, (int) array_pop($a));
            },
            range(0, max(0, $matches[1] - $n))
        );

        return $a;
    }
}