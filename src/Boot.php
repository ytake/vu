<?php

namespace Vu;

use Interop\Container\ContainerInterface;

/**
 * Class Boot
 */
class Boot
{
    /** @var null */
    protected $cacheable;

    /** @var ContainerInterface */
    protected $container;

    /**
     * Boot constructor.
     *
     * @param null               $cacheable
     * @param ContainerInterface $container
     */
    public function __construct($cacheable = null, ContainerInterface $container)
    {
        $this->cacheable = $cacheable;
        $this->container = $container;
    }

    /**
     * @return Framework
     */
    public function instance() : Framework
    {
        if (!$this->cacheable) {
            return $this->container->get('vu://framework');
        }
    }
}
