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

return [
    // file/redis， 建议使用 redis，file 不支持 ttl
    'default' => 'file',

    // 默认锁超时时间
    'ttl' => 300,
    // 是否自动释放，建议设置为 true
    'auto_release' => true,
    // 锁前缀
    'prefix' => 'lock_',

    //文件驱动（给一个文件路径即可）
    'file' => runtime_path('lock'),
    //redis驱动（字符串：认为它是读取缓存的驱动,数组：实例花缓存redis对象, 对象：能操作redis对象）
    'redis' => "redis"
];
