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
     * Content
     *
     * @var string
     */
    private $content;

    /**
     * Content type
     *
     * @var string
     */
    private $contentType;

    /**
     * Constructor
     *
     * @param integer   $code           HTTP Code
     * @param string    $content        HTTP response content
     * @param string    $contentType    HTTP response content type
     */
    public function __construct($code, $content = '', $contentType)
    {
        $this->code         = $code;
        $this->content      = $content;
        $this->contentType  = $contentType;
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
     * Gets content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Gets content type
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }
}
