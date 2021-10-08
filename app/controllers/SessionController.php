<?php
declare(strict_types=1);

namespace Invo\Controllers;

use Invo\Controllers\ControllerBase;
use Invo\Models\Users;

class SessionController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('注册 / 登录');
        
        parent::initialize();
    }
    
    public function indexAction()
    {
        $this->tag->setDefault('email', 'demo');
        $this->tag->setDefault('password', 'phalcon');
    }
    
    public function startAction() 
    {
        if ($this->request->isPost()) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            $user = Users::findFirst([
                "(email = :email: OR username = :email:) AND password = :password: AND active = 1",
                'bind' => [
                    'email' => $email,
                    'password' => sha1($password)
                ]
            ]);
            
            if ($user) {
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
