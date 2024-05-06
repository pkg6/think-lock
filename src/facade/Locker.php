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

namespace tp5er\think\lock\facade;

use Symfony\Component\Lock\LockInterface;

/**
 * Class Locker.
 *
 * @method static LockInterface lock($key)
 */
class Locker extends \think\Facade
{
    /**
     * @return string
     */
    protected static function getFacadeClass()
    {
        return "tp5er.locker";
    }
}
