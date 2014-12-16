<?php

namespace Creads\Api2Symfony\Dumper;

use Creads\Api2Symfony\SymfonyController;

interface DumperInterface
{
    /**
     * Does a file exist in $destination directory for $controller
     *
     * @param  SymfonyController $controller
     * @param  string            $destination
     *
     * @return boolean
     */
    function exists(SymfonyController $controller, $destination = '.');

    /**
     * Dump $controller as a file into $destinaton directory
     *
     * @param  SymfonyController $controller
     * @param  string            $destination
     *
     * @return string File path dumped
     */
    function dump(SymfonyController $controller, $destination = '.');
}