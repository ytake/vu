<?php

namespace Vu\Foundation\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * Class RequestMapping
 * @Annotation
 * @Target("METHOD")
 */
final class RequestMapping
{
    /** @var string $route  route */
    public $route;

    /** @var string $method HTTP method */
    public $method;
}
