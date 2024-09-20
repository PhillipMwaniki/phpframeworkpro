<?php

namespace PhillipMwaniki\Framework\Tests;

class DependantClass
{
    public function __construct(private DependencyClass $dependencyClass)
    {
    }

    public function getDependency(): DependencyClass
    {
        return $this->dependencyClass;
    }

}