<?php

namespace Creads\Api2Symfony;

/**
 * @author Quentin <q.pautrat@creads.org>
 */
class SymfonyResponseContent
{
    /**
     * Content type
     *
     * @var string
     */
    private $type;

    /**
     * Content
     *
     * @var string
     */
    private $content;

    /**
     * Constructor
     *
     * @param string $type    Content type
     * @param string $content Content
     */
    public function __construct($type, $content)
    {
        $this->type = $type;
        $this->content = $content;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Gets content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
