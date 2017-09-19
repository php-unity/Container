<?php

use PHPUnit\Framework\TestCase;
use Unity\Component\Container\Contracts\IDependencyResolver;
use Unity\Component\Container\Contracts\IContainer;
use Unity\Component\Container\Dependency\DependencyResolverFactory;

/**
 * @author Eleandro Duzentos <eleandro@inbox.ru>
 */
class DependencyResolverFactoryTest extends TestCase
{
    public function testMake()
    {
        $containerMock = $this->createMock(IContainer::class);

        $this->assertInstanceOf(
            IDependencyResolver::class,
            DependencyResolverFactory::Make('testId', 'e200', $containerMock)
        );
    }
}
