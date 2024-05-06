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

use Symfony\Component\Lock\Store\FlockStore;
use think\App;

class File extends FlockStore
{
    /**
     * @var mixed|string
     */
    protected $lockPath = "";

    /**
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->lockPath = $app->config->get(
            "locker.file",
            $app->getRuntimePath() . DIRECTORY_SEPARATOR . "lock",
        );
        parent::__construct($this->lockPath);
    }
}
