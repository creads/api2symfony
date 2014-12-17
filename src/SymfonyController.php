<?php

namespace Creads\Api2Symfony;

/**
 * @author Quentin <q.pautrat@creads.org>
 */
class SymfonyController
{
    /**
     * Namespace
     *
     * @var string
     */
    private $namespace;

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
     * Actions
     *
     * @var array
     */
    private $actions;

    /**
     * Constructor
     * @param string $namespace
     * @param string $name
     * @param string $description
     *
     * @todo Checks if name ends with 'Controller'
     */
    public function __construct($name, $namespace = '', $description = '')
    {
        if (!$name || empty($name)) {
            throw new \Exception("You must provide a controller's name");
        }

        $this->namespace = $namespace;
        $this->name = $name;
        $this->description = $description;
        $this->actions = array();
    }

    /**
     * Gets namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
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
     * Sets actions
     *
     * @param array $actions
     */
    public function setActions(array $actions)
    {
        $this->actions = $actions;
    }

    /**
     * Gets actions
     *
     * @return array
     */
    public function getActions()
    {
        return $this->actions;
    }
}
