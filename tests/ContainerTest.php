<?php

use PHPUnit\Framework\TestCase;
use Unity\Component\IoC\Container;
use Unity\Component\IoC\Exceptions\NotFoundException;
use Unity\Component\IoC\Exceptions\DuplicateResolverNameException;
use Test\Helpers\Bar;
use Test\Helpers\Foo;

class ContainerTest extends TestCase
{
	 function testHas()
    {
        $container = $this->getContainerForTest();

        $this->assertEquals(false, $container->has('foo'));

        $container->register('foo', function (){
            return new stdClass();
        });

        $this->assertEquals(true, $container->has('foo'));
    }

    function testGetWithClosure()
    {
        $container = $this->getContainerForTest();

        $container->register('bar', function (){

            return new Bar;
        });
        $this->assertInstanceOf(Bar::class, $container->get('bar'));

        $container->register('foo', function (Container $container){

            $bar = $container->get('bar');

            return new Foo($bar);
        });
        $this->assertInstanceOf(Foo::class, $container->get('foo'));
    }

    function testGetWithInjectableClass()
    {
        $container = $this->getContainerForTest();

        $container->register('foo', Foo::class);
        $this->assertInstanceOf(Foo::class, $container->get('foo'));
    }

    function testNotFoundException()
    {
        $container = $this->getContainerForTest();

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage("No resolver with name \"Nothing\" was found on the container");

        $container->get('Nothing');
    }

    function testDuplicateResolverNameException()
    {
        $container = $this->getContainerForTest();

        $this->expectException(DuplicateResolverNameException::class);
        $this->expectExceptionMessage("There's already a resolver with name \"foo\" on the container");

        $container->register('foo', function (){
            return new stdClass;
        });

        $container->register('foo', function (){
            return new stdClass;
        });
    }

    function testAutowiring()
    {
        $container = $this->getContainerForTest();

        $container->register('foo', Foo::class);

        $container->autoWiring(false);
        $this->assertEquals(Foo::class, $container->get('foo'));

        $container->autoWiring(true);
        $this->assertInstanceOf(Foo::class, $container->get('foo'));
        $this->assertSame($container->get('foo'), $container->get('foo'));
    }

    function getContainerForTest()
    {
        return new Container;
    }
}
