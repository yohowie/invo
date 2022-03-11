<?php
declare(strict_types=1);

namespace Invo\Controllers;

use Invo\Controllers\ControllerBase;
use Invo\Models\Users;

class SessionController extends ControllerBase
{
    /**
     * initialize
     *
     * @return void
     */
    public function initialize()
    {
        $this->tag->setTitle('注册 / 登录');

        parent::initialize();
    }

    /**
     * 登录页面并设置默认用户信息
     *
     * @return void
     */
    public function indexAction()
    {
        $this->tag->setDefault('email', 'demo');
        $this->tag->setDefault('password', 'phalcon');
    }

    /**
     * 用户登录
     *
     * @return void
     */
    public function startAction()
    {
        if ($this->request->isPost()) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = Users::findFirst([
                "(email = :email: OR username = :email:) AND active = 1",
                'bind' => [
                    'email' => $email
                ]
            ]);

            if ($user && $this->security->checkHash($password, $user->password)) {
                $this->registerSession($user);
                $this->flash->success('欢迎 '. $user->name);

                $this->dispatcher->forward([
                    'controller' => 'invoices',
                    'action' => 'index'
                ]);

                return;
            }

            $this->flash->error('电子邮箱/密码错误');
        }

        $this->dispatcher->forward([
            'controller' => 'session',
            'action' => 'index'
        ]);
    }

    /**
     * 将经过身份验证的用户注册到 session 数据中
     *
     * @param Users $user
     * @author Howie
     */
    private function registerSession(Users $user): void
    {
        $this->session->set('auth', [
            'id' => $user->id,
            'name' => $user->name
        ]);
    }
}
