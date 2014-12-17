<?php

namespace Creads\Api2Symfony\Converter;

/**
 * @author Quentin <q.pautrat@creads.org>
 */
interface ConverterInterface
{
    /**
     * Convert given spec into Symfony mockup controller classes
     *
     * @param  mixed    $spec       Given spec
     * @param  string   $namespace  Namespace
     * @return array                List of generated mockup controllers
     */
    public function convert($spec, $namespace);
}
