<?php

namespace Creads\Api2Symfony\Converter;

use Raml\ApiDefinition;
use Raml\Parser;
use Raml\Resource;

use Creads\Api2Symfony\Api2SymfonyConverterInterface;
use Creads\Api2Symfony\SymfonyController;
use Creads\Api2Symfony\SymfonyAction;
use Creads\Api2Symfony\SymfonyRoute;
use Creads\Api2Symfony\SymfonyResponse;

/**
 * Provide a way to convert a RAML specification to a list of SymfonyController
 *
 * @author Quentin <q.pautrat@creads.org>
 */
class RamlConverter implements Api2SymfonyConverterInterface
{
    /**
     * Parser
     *
     * @var Parser
     */
    private $parser;

    /**
     * Constructor
     *
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Recursive method which converts raml resource into action list
     *
     * @param  Resource $resource
     * @param  string   $chainName
     * @return array
     */
    protected function convertResourceToActions(Resource $resource, $chainName = '')
    {
        $actions = array();

        $chainName = $chainName . '_' . strtolower($resource->getDisplayName());

        foreach ($resource->getMethods() as $method) {
            $actionName = strtolower($method->getType()) . str_replace(' ', '', ucwords(str_replace('_', ' ', $chainName))) . 'Action';
            $route = new SymfonyRoute($resource->getUri(), strtolower($method->getType() . $chainName));
            $action = new SymfonyAction($actionName, $route, $method->getType(), $method->getDescription());

            preg_match_all('/\{[a-zA-Z]+\}/', $resource->getUri(), $parameters);
            foreach ($parameters[0] as $parameter) {
                $action->addParameter(substr($parameter, 1, strlen($parameter) - 2));
            }

            if ($method->getResponses()) {
                foreach ($method->getResponses() as $code => $response) {
                    if (200 === $code) {
                        $action->setResponse(new SymfonyResponse($code, str_replace('\'', '\\\'', $response->getExampleByType('application/json')), 'application/json'));
                    }
                }
            }

            $actions[] = $action;
        }

        foreach ($resource->getResources() as $subresource) {
            $actions = array_merge($actions, $this->convertResourceToActions($subresource, $chainName));
        }

        return $actions;
    }

    /**
     * Build namespace given ApiDefinition and base namespace
     *
     * @param  ApiDefinition $definition Checks if definition has version
     * @param  string        $namespace  Base
     * @return string
     */
    protected function buildNamespace(ApiDefinition $definition, $namespace)
    {
        if ($definition->getVersion()) {
            $namespace .= '\\' . preg_replace('/[^a-zA-Z0-9]/', '_', $definition->getVersion());
        }

        return $namespace;
    }

    /**
     * @see Api2SymfonyConverterInterface::convert()
     */
    public function convert($spec, $namespace)
    {
        $def = $this->parser->parse($spec);

        $namespace = $this->buildNamespace($def, $namespace);

        $controllers = array();

        if ($def->getResources()) {
            foreach ($def->getResources() as $resource) {

                $controller = new SymfonyController(ucfirst($resource->getDisplayName()) . 'Controller', $namespace, $resource->getDescription());
                $controller->setActions($this->convertResourceToActions($resource));
                $controllers[] = $controller;
            }
        }

        return $controllers;
    }
}
