<?php

namespace Unity\Component\Container\Exceptions;

use Exception;
use Psr\Container\NotFoundExceptionInterface;
use Throwable;

/**
 * Class ContainerException.
 *
 *
 * @author Eleandro Duzentos <eleandro@inbox.ru>
 */
class ContainerException extends Exception implements NotFoundExceptionInterface
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
