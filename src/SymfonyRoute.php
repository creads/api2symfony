<?php

namespace Creads\Api2Symfony;

/**
 * @author Quentin <q.pautrat@creads.org>
 */
class SymfonyRoute
{
    /**
     * Path
     *
     * @var string
     */
    private $path;

    /**
     * Name
     *
     * @var string
     */
    private $name;

    /**
     * Constructor
     *
     * @param string $path
     * @param string $name
     */
    public function __construct($path, $name)
    {
        if (!$path || empty($path)) {
            throw new \Exception("You must provide a route's path");
        }

        if (!$name || empty($name)) {
            throw new \Exception("You must provide a route's name");
        }

        $this->path = $path;
        $this->name = $name;
    }

    /**
     * Gets path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
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
}