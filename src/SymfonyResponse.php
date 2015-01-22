<?php

namespace Creads\Api2Symfony;

/**
 * @author Quentin <q.pautrat@creads.org>
 */
class SymfonyResponse
{
    /**
     * HTTP Code
     *
     * @var integer
     */
    private $code;

    /**
     * Headers
     *
     * @var array
     */
    private $headers;

    /**
     * Contents
     *
     * @var array
     */
    private $contents;

    /**
     * Constructor
     *
     * @param integer   $code           HTTP Code
     * @param array header
     */
    public function __construct($code, array $headers = array())
    {
        $this->code         = $code;
        $this->headers      = $headers;
    }

    /**
     * Gets code
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Add content
     *
     * @param SymfonyResponseContent $content
     * @return  self
     */
    public function addContent(SymfonyResponseContent $content)
    {
        $this->contents[] = $content;

        return $this;
    }

    /**
     * Get contents
     *
     * @return array
     */
    public function getContents()
    {
        return $this->contents;
    }
}
