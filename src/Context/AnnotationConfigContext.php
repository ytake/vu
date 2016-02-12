<?php

namespace Vu\Context;

use Doctrine\Common\Annotations\AnnotationReader;

/**
 * Class AnnotationConfigContext
 */
class AnnotationConfigContext
{
    /** @var AnnotationReader  */
    protected $reader;

    /**
     * AnnotationConfigContext constructor.
     */
    public function __construct()
    {
        $this->reader = new AnnotationReader;
    }
}