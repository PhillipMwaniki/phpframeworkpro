<?php

namespace PhillipMwaniki\Framework\Tests;

class DependencyClass
{
    public function __construct(private SubDependency $subDependency)
    {
    }

    public function getSubDependency(): SubDependency
    {
        return $this->subDependency;
    }
}