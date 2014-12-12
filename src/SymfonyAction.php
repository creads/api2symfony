<?php

namespace Creads\Api2Symfony;

/**
 * @author Quentin <q.pautrat@creads.org>
 */
class SymfonyAction
{
    /**
     * Name
     *
     * @var string
     */
    private $name;

    /**
     * Description
     *
     * @var string
     */
    private $description;

    /**
     * Route
     *
     * @var SymfonyActionRoute
     */
    private $route;

    /**
     * Method
     *
     * @var string
     */
    private $method;

    /**
     * Parameters
     *
     * @var array
     */
    private $parameters;

    /**
     * Response
     *
     * @var SymfonyResponse
     */
    private $response;

    /**
     * Constructor
     *
     * @param string             $name
     * @param SymfonyActionRoute $route
     * @param string             $method
     * @param string             $description
     *
     * @todo Checks if name ends with 'Action'
     */
    public function __construct($name, SymfonyRoute $route, $method, $description = '')
    {
        if (!$name || empty($name)) {
            throw new \Exception("You must provide a action's name");
        }

        if (!$method || empty($method)) {
            throw new \Exception("You must provide a action's method");
        }

        $this->name = $name;
        $this->route = $route;
        $this->method = $method;
        $this->description = $description;
        $this->parameters = array();
    }

    /**
     * Factory method for chainability
     *
     * @param  string       $name
     * @param  SymfonyRoute $route
     * @param  string       $method
     * @param  string       $description
     * @return SymonyAction
     */
    public static function create($name, SymfonyRoute $route, $method, $description = '')
    {
        return new static($name, $route, $method, $description);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Gets route
     *
     * @return SymfonyActionRoute
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Gets method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Adds parameter
     *
     * @param string $parameter
     * @return SymfonyAction Fluent method
     */
    public function addParameter($parameter)
    {
        $this->parameters[] = $parameter;

        return $this;
    }

    /**
     * Gets parameters
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Sets response
     *
     * @param SymfonyResponse $response
     * @return SymfonyAction Fluent interface
     */
    public function setResponse(SymfonyResponse $response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Gets response
     *
     * @return SymfonyResponse
     */
    public function getResponse()
    {
        return $this->response;
    }
}