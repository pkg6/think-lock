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

namespace tp5er\think\lock;

use Symfony\Component\Lock\LockFactory;
use Symfony\Component\Lock\LockInterface;
use think\Manager;
use tp5er\think\lock\drivers\File;
use tp5er\think\lock\drivers\Redis;

class LockerManager extends Manager
{
    protected $factory = null;
    /**
     * @var string[]
     */
    protected $drivers = [
        'file' => File::class,
        "redis" => Redis::class,
    ];

    /**
     * @return LockFactory
     */
    public function factory()
    {
        if ( ! is_null($this->factory)) {
            return $this->factory;
        }
        $driver = $this->driver();
        $this->factory = new LockFactory(new $driver($this->app));

        return $this->factory;
    }

    /**
     * @return array|mixed|string|null
     */
    public function getDefaultDriver()
    {
        return $this->app->config->get('lock.default', 'file');
    }

    /**
     * 创建锁
     *
     * @param string $key
     * @param float|null $ttl 锁超时时间
     * @param bool|null $autoRelease 是否自动释放锁
     * @param string|null $prefix 锁前缀
     *
     * @return LockInterface
     */
    public function createLock($key, $ttl = null, $autoRelease = null, $prefix = null)
    {
        $config = $this->app->config->get("locker");
        $ttl = $ttl ?: ($config['ttl'] ?? 300);
        $autoRelease = $autoRelease ?: ($config['auto_release'] ?? true);
        $prefix = $prefix ?: ($config['prefix'] ?? 'lock_');

        return $this->factory()->createLock($prefix . $key, $ttl, $autoRelease);
    }

    /**
     * @param $method
     * @param $parameters
     *
     * @return mixed|LockInterface
     */
    public function __call($method, $parameters)
    {
        return $this->createLock(...$parameters);
    }

}
