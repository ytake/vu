<?php

namespace Vu;

use Relay\RelayBuilder;

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
}
