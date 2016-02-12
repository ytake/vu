<?php

namespace Vu;

use Relay\RelayBuilder;
use Vu\Foundation\ConfigureEnvironment;

/**
 * Class Framework
 */
class Framework
{
    /** @var RelayBuilder  */
    protected $builder;

    /**
     * Framework constructor.
     *
     * @param RelayBuilder $builder
     */
    public function __construct(RelayBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param string $path
     */
    protected function webEnvironment($path = __DIR__)
    {
        $dotenv = new ConfigureEnvironment(new \Dotenv\Dotenv($path));
    }
}
