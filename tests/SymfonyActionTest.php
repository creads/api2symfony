<?php

namespace Creads\Tests\Api2Symfony;

use Creads\Api2Symfony\SymfonyAction;

class SymfonyActionTest extends \PHPUnit_Framework_TestCase
{
    protected function getMockedRoute()
    {
        return $this->getMock('Creads\Api2Symfony\SymfonyRoute', array(), array('/route_path', 'route_name'));
    }

    protected function getMockedResponse()
    {
        return $this->getMock('Creads\Api2Symfony\SymfonyResponse', array(), array('/route_path', 'route_name', 'application\json'));
    }

    public function testConstruct()
    {
        $route = $this->getMockedRoute();
        $action = new SymfonyAction('myname', $route, 'get', 'my description');

        $this->assertEquals('myname', $action->getName());
        $this->assertSame($route, $action->getRoute());
        $this->assertEquals('get', $action->getMethod());
        $this->assertEquals('my description', $action->getDescription());
    }

    public function testConstructDefaultValue()
    {
        $route = $this->getMockedRoute();
        $action = new SymfonyAction('myname', $route, 'get');
        $this->assertEquals('', $action->getDescription());
        $this->assertEquals(array(), $action->getParameters());
    }

    public function testAddParameterAndGetParameters()
    {
        $route = $this->getMockedRoute();
        $action = new SymfonyAction('myname', $route, 'get', 'my description');
        $action->addParameter('my-parameter');

        $this->assertEquals(array('my-parameter'), $action->getParameters());
    }

    public function testSetResponseAndGetResponse()
    {
        $route = $this->getMockedRoute();
        $action = new SymfonyAction('myname', $route, 'get', 'my description');
        $response = $this->getMockedResponse();
        $action->setResponse($response);

        $this->assertSame($response, $action->getResponse());
    }

    /**
     * @expectedException           Exception
     * @expectedExceptionMessage    You must provide a action's name
     */
    public function testNoName()
    {
        $route = $this->getMockedRoute();
        new SymfonyAction('', $route, 'get');
    }

    /**
     * @expectedException           Exception
     * @expectedExceptionMessage    You must provide a action's method
     */
    public function testNoMethod()
    {
        $route = $this->getMockedRoute();
        new SymfonyAction('test', $route, '');
    }
}