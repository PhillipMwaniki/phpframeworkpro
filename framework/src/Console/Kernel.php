<?php

namespace PhillipMwaniki\Framework\Console;

use DirectoryIterator;
use PhillipMwaniki\Framework\Console\Command\CommandInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionClass;
use ReflectionException;

class Kernel
{

    public function __construct(private ContainerInterface $container)
    {
    }

    public function handle(): int
    {
        $this->registerCommands();
        return 0;
    }

    /**
     * @throws ReflectionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function registerCommands(): void
    {
        $commandFiles = new DirectoryIterator(__DIR__ . '/Command');

        $namespace = $this->container->get('base-commands-namespace');

        foreach ($commandFiles as $commandFile) {
            if (!$commandFile->isFile()) {
                continue;
            }

            $command = $namespace.pathinfo($commandFile, PATHINFO_FILENAME);

            if (is_subclass_of($command, CommandInterface::class)) {
                $commandName = (new ReflectionClass($command))->getProperty('name')->getDefaultValue();
                $this->container->add($commandName, $command);
            }
        }

        dd($this->container);
    }

}