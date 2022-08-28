<?php

namespace App\Static;

use App\Annotation\EmptyCache;
use Doctrine\DBAL\Platforms\MySQL80Platform;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Doctrine\Persistence\Mapping\Driver\StaticPHPDriver;

class EntityManagerFactory
{
    public static function create(): EntityManagerInterface
    {
        $config = Setup::createConfiguration(
            false,
            __DIR__ . '/../Proxy',
            new EmptyCache()
        );
        $config->setMetadataDriverImpl(
            new StaticPHPDriver([__DIR__ . '/Entity'])
        );

        $connection = [
            'driver' => 'pdo_mysql',
            'platform' => new MySQL80Platform(),
        ];

        return EntityManager::create($connection, $config);
    }
}
