<?php

namespace Vu\Foundation;

use Dotenv\Dotenv;

/**
 * Class ConfigureEnvironment
 */
class ConfigureEnvironment
{
    /** @var Dotenv  */
    protected $env;

    /**
     * ConfigureEnvironment constructor.
     *
     * @param Dotenv $env
     */
    public function __construct(Dotenv $env)
    {
        $this->env = $env;
    }
}
