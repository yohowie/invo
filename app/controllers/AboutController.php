<?php
declare(strict_types=1);

namespace Invo\Controllers;

class AboutController extends ControllerBase
{
    public function initialize(): void
    {
        parent::initialize();

        $this->tag->setTitle('关于我们');
    }

    public function indexAction(): void
    {

    }
}