<?php
declare(strict_types=1);

namespace Invo\Controllers;

use Invo\Forms\RegisterForm;
use Invo\Models\Users;
use Phalcon\Db\RawValue;

class RegisterController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('注册 / 登录');
        
        parent::initialize();
    }
    
    public function indexAction()
    {
        $form = new RegisterForm();
        
        if ($this->request->isPost()) {
            $password = $this->request->getPost('password');
            $repeatPassword = $this->request->getPost('repeatPassword');
            
            if ($password !== $repeatPassword) {
                $this->flash->error('密码不一样');
                
                return;
            }
            
            $user = new Users();
            $user->username = $this->request->getPost('username', 'alpha');
            $user->password = sha1($password);
            $user->name = $this->request->getPost('name', ['string', 'striptags']);
            $user->email = $this->request->getPost('email', 'email');
            $user->created_at = new RawValue('now()');
            $user->active = 1;
            
            if (!$user->save()) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                $this->tag->setDefault('email', '');
                $this->tag->setDefault('password', '');
                
                $this->flash->success('感谢注册，请登录并开始生成发票');
                
                $this->dispatcher->forward([
                    'controller' => 'session',
                    'action' => 'index'
                ]);
                
                return;
            }
        }
        
        $this->view->form = $form;
    }
}
