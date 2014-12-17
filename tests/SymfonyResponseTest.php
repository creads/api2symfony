<?php

namespace Creads\Tests\Api2Symfony;

use Creads\Api2Symfony\SymfonyResponse;

class SymfonyResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $route = new SymfonyResponse(200, 'my content', 'application/json');

        $this->assertEquals(200, $route->getCode());
        $this->assertEquals('my content', $route->getContent());
        $this->assertEquals('application/json', $route->getContentType());
    }
}