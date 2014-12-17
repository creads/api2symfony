<?php

namespace Creads\Api2Symfony\Converter;

/**
 * @author Quentin <q.pautrat@creads.org>
 */
interface ConverterInterface
{
    /**
     * Convert a given specification
     *
     * @param  mixed    $filepath   Filepath to specification
     * @param  string   $namespace  Destination namespace
     *
     * @return array                A list of SymfonyController
     */
    public function convert($filepath, $namespace);
}
