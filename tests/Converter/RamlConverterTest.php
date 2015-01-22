<?php

namespace Creads\Tests\Api2Symfony\Converter;

use Raml\Parser;
use Creads\Api2Symfony\Converter\RamlConverter;

class RamlConverterTest extends \PHPUnit_Framework_TestCase
{
    public static $converter;

    public static function setUpBeforeClass()
    {
        self::$converter = new RamlConverter();
    }

    public function parseRaml($raml)
    {
        return self::$converter->convert(__DIR__ . '/../fixtures/' . $raml, 'Foo\\Bar');
    }

    public function testNoResource()
    {
        $this->assertEmpty($this->parseRaml('no_resource.raml'));
    }

    public function testSimpleResource()
    {
        $this->assertCount(1, $this->parseRaml('simple_resource.raml'));
    }

    public function testNamespace()
    {
        $this->assertEquals('Foo\\Bar', $this->parseRaml('simple_resource.raml')[0]->getNamespace());
    }

    public function testNamespaceWithVersion()
    {
        $this->assertEquals('Foo\\Bar\\1_0_0_alpha_1', $this->parseRaml('namespace_version.raml')[0]->getNamespace());
    }

    public function testMultipleResource()
    {
        $this->assertCount(2, $this->parseRaml('multiple_resource.raml'));
    }

    public function testResourceDescription()
    {
        $this->assertEquals('Collection of available post resource', $this->parseRaml('description_resource.raml')[0]->getDescription());
    }

    public function testResourceWithoutName()
    {
        $this->assertEquals('PostsController', $this->parseRaml('simple_resource.raml')[0]->getName());
    }

    public function testResourceWithName()
    {
        $this->assertEquals('ApiPostsController', $this->parseRaml('name_resource.raml')[0]->getName());
    }

    public function testSimpleMethod()
    {
        $controllers = $this->parseRaml('simple_method.raml');
        $this->assertCount(1, $controllers[0]->getActions());
        $this->assertEquals('getPostsAction', $controllers[0]->getActions()[0]->getName());
    }

    public function testDescriptionMethod()
    {
        $this->assertEquals('Get a list of posts', $this->parseRaml('description_method.raml')[0]->getActions()[0]->getDescription());
    }

    public function testMultipleMethod()
    {
        $this->assertCount(2, $this->parseRaml('multiple_method.raml')[0]->getActions());
    }

    public function testSubresource()
    {
        $controllers = $this->parseRaml('subresource.raml');

        $this->assertCount(1, $controllers[0]->getActions());
        $this->assertEquals('getPostsPostAction', $controllers[0]->getActions()[0]->getName());
        $this->assertEquals('Get a post', $controllers[0]->getActions()[0]->getDescription());
    }

    public function testActionRoute()
    {
        $this->assertEquals('/posts', $this->parseRaml('action_route.raml')[0]->getActions()[0]->getRoute()->getPath());
        $this->assertEquals('get_posts', $this->parseRaml('action_route.raml')[0]->getActions()[0]->getRoute()->getName());
        $this->assertEquals('/posts/{id}', $this->parseRaml('action_route.raml')[0]->getActions()[1]->getRoute()->getPath());
        $this->assertEquals('get_posts_post', $this->parseRaml('action_route.raml')[0]->getActions()[1]->getRoute()->getName());
    }

    public function testUriParameters()
    {
        $parameters = $this->parseRaml('uri_parameters.raml')[0]->getActions()[0]->getParameters();

        $this->assertCount(3, $parameters);
        $this->assertEquals('slug', $parameters[0]);
        $this->assertEquals('page', $parameters[1]);
        $this->assertEquals('id', $parameters[2]);
    }

    public function testMockResponse()
    {
        $response = $this->parseRaml('mock_response.raml')[0]->getActions()[0]->getResponses()[0];
        $this->assertEquals(200, $response->getCode());
        $this->assertEquals('application/json', $response->getContents()[0]->getType());
    }

    public function testResponseHeaders()
    {
        $headers = $this->parseRaml('response_headers.raml')[0]->getActions()[0]->getResponses()[0]->getHeaders();
        $this->assertArrayNotHasKey('Foo', $headers);
        $this->assertArrayHasKey('Bar', $headers);
        $this->assertArrayHasKey('FooBar', $headers);
        $this->assertEquals('Foo', $headers['Bar']);
        $this->assertEmpty($headers['FooBar']);
    }

    public function testMultipleResponseCode()
    {
        $responses = $this->parseRaml('multiple_response.raml')[0]->getActions()[0]->getResponses();
        $this->assertCount(4, $responses);
    }

    public function testMultipleResponseContentType()
    {
        self::$converter = new RamlConverter(array('allowed_response_types' => array(
            'application/json',
            'application/xml'
        )));
        $contents = $this->parseRaml('multiple_response_content_type.raml')[0]->getActions()[0]->getResponses()[0]->getContents();
        $this->assertCount(2, $contents);
    }
}