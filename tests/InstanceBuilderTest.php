<?php

use Unity\Component\IoC\InstanceBuilder;
use Test\Helpers\Foo;
use Test\Helpers\Bar;

class InstanceBuilderTest extends TestCase
{
    function testGetReflectionClass()
    {
        $ib = new InstanceBuilderTester;

        $this->assertInstanceOf(\ReflectionClass::class, $ib->getReflectionClass(Bar::class));
    }

    function testIsInjectable()
    {
        $bi = new InstanceBuilderTester;

        $refClass = $bi->getReflectionClass(Foo::class);

        $this->assertEquals(true, $bi->isInjectable($refClass));
    }

    function testIsNotInjectable()
    {
        $bi = new InstanceBuilderTester;

        $refClass = $bi->getReflectionClass(Bar::class);

        $this->assertEquals(false, $bi->isInjectable($refClass));
    }

    function testHasParameters()
    {
        $db = new InstanceBuilderTester;

        $refClass = new ReflectionClass(Foo::class);

        $this->assertEquals(true, $db->hasParameters($refClass));
    }

    function testHasNotParameters()
    {
        $db = new InstanceBuilderTester;

        $refClass = new ReflectionClass(Bar::class);

        $this->assertEquals(false, $db->hasParameters($refClass));
    }

    function testGetParametersType()
    {
        $db = new InstanceBuilderTester;

        $refClass = new ReflectionClass(Foo::class);

        $this->assertEquals([
            Bar::class
        ], $db->getParametersType($refClass));

        $refClass = new ReflectionClass(Bar::class);

        $this->assertEquals([], $db->getParametersType($refClass));
    }

    function testHasInjectableAnnotation()
    {
        $ib = new InstanceBuilderTester;

        $value = $ib->hasInjectableAnnotation('/**
         * Class Foo
         * @Injectable
         */');

        $this->assertEquals(true, $value);
    }

    function testHasDependencies()
    {
        $ib = new InstanceBuilderTester;

        $refClass = $ib->getReflectionClass(Foo::class);

        /**
         * This method set the $hasDependency,
         * so, we need to run it first to check
         * if the class has or not dependencies
         */
        $ib->getDependencies($refClass);

        $this->assertEquals(true, $ib->hasDependencies());
    }

    function testHasNotDependencies()
    {
        $ib = new InstanceBuilderTester;

        $refClass = new ReflectionClass(Bar::class);

        $ib->getDependencies($refClass);

        $this->assertEquals(false, $ib->hasDependencies());
    }

    function testBuild()
    {
        $ib = new InstanceBuilderTester;

        $instance = $ib->build(Foo::class);

        $this->assertInstanceOf(Foo::class, $instance);
    }
}

class InstanceBuilderTester extends InstanceBuilder
{
    function __construct() {}

    public function hasParameters(\ReflectionClass $refClass)
    {
        return parent::hasParameters($refClass);
    }
    
    public function getParametersType(\ReflectionClass $refClass)
    {
        return parent::getParametersType($refClass);
    }
    
    public function resolve($class)
    {
        return parent::resolve($class);
    }

    public function getDependencies(\ReflectionClass $refClass)
    {
        return parent::getDependencies($refClass);
    }

    public function hasDependencies()
    {
        return parent::hasDependencies();
    }

    public function getReflectionClass($class = null)
    {
        return parent::getReflectionClass($class);
    }

    public function isInjectable(\ReflectionClass $refClass)
    {
        return parent::isInjectable($refClass);
    }

    public  function hasInjectableAnnotation($annotations)
    {
        return parent::hasInjectableAnnotation($annotations);
    }
}