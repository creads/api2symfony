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
        $this->description = str_replace(array("\r\n", "\n", "\r", "\t", "  "), '', $description);
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
     * Add an action to controller. If an action with the same name alreaday exists, it will erase it.
     *
     * @param SymfonyAction $action An array of SymfonyAction
     */
    public function addAction(SymfonyAction $action)
    {
        $this->actions[] = $action;
    }

    /**
     * Gets actions
     *
     * @return array An array of SymfonyAction
     */
    public function getActions()
    {
        return $this->actions;
    }
}
