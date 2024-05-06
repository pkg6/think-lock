# 安装

```
composer require tp5er/think-lock
```

# 使用

```
<?php

namespace app\controller;

use app\BaseController;
use tp5er\think\lock\facade\Locker;

class Index extends BaseController
{
    public function index()
    {
        $lock = Locker::lock("index");
        if (!$lock->acquire()) {
            throw new \Exception('操作太频繁，请稍后再试');
        }
        try {
            //TODO 业务操作
        } finally {
            $lock->release();
        }
    }
}
```

更多操作参考：[symfony/lock](https://symfony.com/doc/current/components/lock.html) 文档
