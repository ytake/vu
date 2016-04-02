<?php

namespace Vu\Response;

use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\Response\EmitterInterface;

/**
 * Class Emitter
 */
class Emitter extends AbstractEmitter
{
    /**
     * @return \Zend\Diactoros\Response\EmitterInterface
     */
    public function getEmitter() : EmitterInterface
    {
        return new SapiEmitter();
    }
}
