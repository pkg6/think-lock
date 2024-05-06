<?php

/*
 * This file is part of the tp5er/think-locker
 *
 * (c) pkg6 <https://github.com/pkg6>
 *
 * (L) Licensed <https://opensource.org/license/MIT>
 *
 * (A) zhiqiang <https://www.zhiqiang.wang>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace tp5er\think\lock\drivers;

use Symfony\Component\Lock\Exception\InvalidArgumentException;
use Symfony\Component\Lock\Store\RedisStore;
use think\App;

class Redis extends RedisStore
{

    /**
     * @var array|mixed
     */
    protected $redis;

    public function __construct(App $app)
    {
        $this->redis = $this->thinkRedis($app);
        parent::__construct($this->redis);
    }

    /**
     * @param App $app
     *
     * @return \Redis|\RedisArray|\RedisCluster|RedisProxy|RedisClusterProxy|\Predis\ClientInterface
     */
    public function thinkRedis(App $app)
    {
        $redis = $app->config->get("locker.redis");
        if ($redis instanceof \Redis
            || $redis instanceof \RedisArray
            || $redis instanceof \RedisCluster
            || $redis instanceof \Predis\ClientInterface
            || $redis instanceof RedisProxy
            || $redis instanceof RedisClusterProxy) {
            return $redis;
        } elseif (is_string($redis)) {
            return $app->cache->store($redis)->handler();
        } elseif (is_array($redis)) {
            return (new \think\cache\driver\Redis($redis))->handler();
        } else {
            throw new InvalidArgumentException("This configuration is not supported");
        }
    }
}
