<?php

namespace Creads\Tests\Api2Symfony;

use Creads\Api2Symfony\SymfonyRoute;

class SymfonyRouteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException           Exception
     * @expectedExceptionMessage    You must provide a route's path
     */
    public function testNoPath()
    {
        new SymfonyRoute('', 'foo');
    }

    /**
     * @expectedException           Exception
     * @expectedExceptionMessage    You must provide a route's name
     */
    public function testNoName()
    {
        new SymfonyRoute('/foo', '');
    }
}