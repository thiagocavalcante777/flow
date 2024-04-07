<?php

namespace App\Infrastructure\Adapter\RedisClient;

use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Cache\Adapter\RedisTagAwareAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class RedisClient
{
    private $cache;

    public function __construct()
    {
        $redisDSN = 'redis://'.$_ENV['REDIS_PASSWORD'].'@'.$_ENV['REDIS_HOST'].':'.$_ENV['REDIS_PORT'];
        $client = RedisAdapter::createConnection($redisDSN);
        $this->cache = new RedisTagAwareAdapter($client);
    }

    public function setArray(string $key, array $value, ?int $lifeTime = 60): void
    {
        $this->set($key, base64_encode(json_encode($value)), $lifeTime);
    }

    public function getArray(string $key)
    {
        return json_decode(base64_decode($this->get($key)));
    }

    public function set(string $key, string $value, ?int $lifeTime = 60): void
    {
        $item = $this->cache->getItem($key);
        $item->set($value);
        $item->expiresAfter($lifeTime);

        $this->cache->save($item);
    }

    public function get(string $key)
    {
        $valor = $this->cache->get($key, function (ItemInterface $item) use($key) {
            return $item->get($key);
        });

        return $valor;
    }
}