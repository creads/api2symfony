<?php

namespace Creads\Api2Symfony;

/**
 * @author Quentin <q.pautrat@creads.org>
 */
interface Api2SymfonyConverterInterface
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
