<?php

use Creads\Api2Symfony\SymfonyController;

class SymfonyControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException           Exception
     * @expectedExceptionMessage    You must provide a controller's name
     */
    public function testNoName()
    {
        new SymfonyController('');
    }
}