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

class Service extends \think\Service
{
    public function register()
    {
        $this->app->bind('tp5er.locker', function () {
            return new LockerManager($this->app);
        });
    }
}
