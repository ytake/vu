<?php

namespace Vu;

use League\Container\ContainerInterface;

/**
 * Class Dependencies
 * application dependencies
 */
class Dependencies
{
    /**
     * @param ContainerInterface $container
     */
    public function define(ContainerInterface $container)
    {
        // for middleware
        $container->add('Relay\RelayBuilder', 'Relay\RelayBuilder');
        // psr http message
        $container->add('Psr\Http\Message\ResponseInterface', 'Zend\Diactoros\Response');
        //
        $container->add('Vu\Router\RouteInterface', 'Vu\Router\Route');

        $container->add('Vu\Response\AbstractEmitter', 'Vu\Response\Emitter');
        $container->add('vu://router', 'Vu\Router\Router')
            ->withArgument('Vu\Router\RouteInterface');
        $container->add('vu://framework', 'Vu\Foundation\Application')
            ->withArguments([
                'Relay\RelayBuilder',
                $container
            ]);
    }
}
