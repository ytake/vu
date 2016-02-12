<?php

namespace Vu;

use League\Container\Container;

/**
 * Class Dependencies
 */
class Dependencies
{
    /**
     * @param Container $container
     */
    public function define(Container $container)
    {
        $container->add('Relay\RelayBuilder', 'Relay\RelayBuilder');
        $container->add('Psr\Http\Message\ResponseInterface', 'Zend\Diactoros\Response');
        $container->add('vu://framework', 'Vu\Framework')
            ->withArgument('Relay\RelayBuilder');
    }
}
