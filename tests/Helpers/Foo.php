<?php

namespace Test\Helpers;

/**
 * Class Foo
 * @Injectable
 */
class Foo
{
    public $bar;

    function __construct(Bar $bar)
    {
        $this->bar = $bar;
    }
}