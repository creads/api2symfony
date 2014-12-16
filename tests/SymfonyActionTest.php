<?php

namespace Creads\Tests\Api2Symfony;

use Creads\Api2Symfony\SymfonyAction;

class SymfonyActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException           Exception
     * @expectedExceptionMessage    You must provide a action's name
     */
    public function testNoName()
    {
        new SymfonyAction('', $this->getMock('Creads\Api2Symfony\SymfonyRoute', array(), array(), '', false), 'get');
    }

    /**
     * @expectedException           Exception
     * @expectedExceptionMessage    You must provide a action's method
     */
    public function testNoMethod()
    {
        new SymfonyAction('test', $this->getMock('Creads\Api2Symfony\SymfonyRoute', array(), array(), '', false), '');
    }
}