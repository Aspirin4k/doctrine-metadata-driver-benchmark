<?php

namespace App\RedisCache;

use App\Annotation\EmptyCache;
use Doctrine\DBAL\Platforms\MySQL80Platform;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Cache\Adapter\RedisAdapter;

class EntityManagerFactory
{
    public static function create(): EntityManagerInterface
    {
        $redis = new \Redis();
        $redis->connect('redis');

        $config = Setup::createAnnotationMetadataConfiguration(
            [__DIR__ . '/../Annotation/Entity'],
            false,
            __DIR__ . '/../Proxy',
            new EmptyCache(),
            false
        );
        $config->setMetadataCache(new RedisAdapter($redis));

        $connection = [
            'driver' => 'pdo_mysql',
            'platform' => new MySQL80Platform(),
        ];

        return EntityManager::create($connection, $config);
    }
}
