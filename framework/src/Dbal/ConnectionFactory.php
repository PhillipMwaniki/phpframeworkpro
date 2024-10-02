<?php

namespace PhillipMwaniki\Framework\Dbal;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

readonly class ConnectionFactory
{
    public function __construct(private string $databaseUrl)
    {
    }

    public function create(): Connection
    {
        return DriverManager::getConnection(['url' => $this->databaseUrl, 'driver' => 'pdo_sqlite']);
    }
}