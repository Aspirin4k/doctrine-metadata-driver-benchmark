<?php

namespace App\ApcuCache;

use Doctrine\Common\Cache\Psr6\DoctrineProvider;
use Doctrine\DBAL\Platforms\MySQL80Platform;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Cache\Adapter\ApcuAdapter;

class EntityManagerFactory
{
    public static function create(): EntityManagerInterface
    {
        $config = Setup::createAnnotationMetadataConfiguration(
            [__DIR__ . '/../Annotation/Entity'],
            false,
            __DIR__ . '/../Proxy',
            DoctrineProvider::wrap(
                new ApcuAdapter()
            ),
            false
        );

        $connection = [
            'driver' => 'pdo_mysql',
            'platform' => new MySQL80Platform(),
        ];

        return EntityManager::create($connection, $config);
    }
}
