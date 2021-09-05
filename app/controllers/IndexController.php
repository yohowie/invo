<?php
declare(strict_types=1);

namespace Invo\Controllers;

use Invo\Controllers\ControllerBase;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->flash->notice('这是 Phalcon 框架的示例应用程序。请不要向我们提供任何个人信息。谢谢！');
    }

}

