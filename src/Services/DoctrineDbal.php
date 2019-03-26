<?php

namespace InsteadSite\Services;

use Psr\Container;
use Doctrine\DBAL;

class DoctrineDbal
{
    /**
     * @param Container\ContainerInterface $container
     * @return DBAL\Connection
     * @throws DBAL\DBALException
     */
    public function __invoke(Container\ContainerInterface $container): DBAL\Connection
    {
        return DBAL\DriverManager::getConnection($container['settings']['db']);
    }

}
