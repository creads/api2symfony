<?php

namespace Creads\Tests\Api2Symfony;

use Creads\Api2Symfony\SymfonyController;

class SymfonyControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $controller = new SymfonyController('mycontroller', 'A\Namespace', 'a description');

        $this->assertEquals('mycontroller', $controller->getName());
        $this->assertEquals('A\Namespace', $controller->getNamespace());
        $this->assertEquals('a description', $controller->getDescription());
    }

    public function testConstructDefaultValues()
    {
        $controller = new SymfonyController('my controller');

        $this->assertEquals('', $controller->getNamespace());
        $this->assertEquals('', $controller->getDescription());
    }

    /**
     * @expectedException           Exception
     * @expectedExceptionMessage    You must provide a controller's name
     */
    public function testNoName()
    {
        new SymfonyController('');
    }
}