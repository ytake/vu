<?php

namespace Vu\Response;

use Zend\Diactoros\Response\EmitterInterface;

/**
 * Class Emitter
 */
abstract class AbstractEmitter
{
    /**
     * @return \Zend\Diactoros\Response\EmitterInterface
     */
    abstract public function getEmitter() : EmitterInterface;
}
