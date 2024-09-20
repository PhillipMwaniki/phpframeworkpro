<?php

namespace PhillipMwaniki\Framework\Tests;

use PhillipMwaniki\Framework\Container\Container;
use PhillipMwaniki\Framework\Container\ContainerException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{
    #[Test]
    public function a_service_can_be_retrieved_from_the_container()
    {
        // setup a container
        $container = new Container();

        // add will have two args: id - string, concrete - string|object (className string or object)
        $container->add('dependant-class', DependantClass::class);

        // assertions
        $this->assertInstanceOf(DependantClass::class, $container->get('dependant-class'));
    }

    #[Test]
    public function a_containerException_is_thrown_if_a_service_cannot_be_foud()
    {
        $container = new Container();

        $this->expectException(ContainerException::class);

        $container->add('foobar');
    }

    #[Test]
    public function can_check_if_the_container_has_a_service(): void
    {
        // Setup
        $container = new Container();

        // Do something
        $container->add('dependant-class', DependantClass::class);

        $this->assertTrue($container->has('dependant-class'));
        $this->assertFalse($container->has('non-existent-class'));
    }

    #[Test]
    public function services_can_be_recursively_autowired()
    {
        $container = new Container();

        $dependantService = $container->get(DependantClass::class);

        $dependencyService = $dependantService->getDependency();


        $this->assertInstanceOf(DependencyClass::class, $dependencyService);
        $this->assertInstanceOf(SubDependency::class, $dependencyService->getSubDependency());
    }
}