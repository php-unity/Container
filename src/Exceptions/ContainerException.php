<?php

namespace Unity\Component\IoC\Exceptions;

use Psr\Container\NotFoundExceptionInterface;

/**
 * Class ContainerException
 * @package Unity\Component\IoC\Exceptions
 */
class ContainerException extends \Exception implements NotFoundExceptionInterface
{

}