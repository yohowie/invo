<?php
declare(strict_types=1);

namespace Invo\Controllers;

use Invo\Controllers\ControllerBase;
use Invo\Models\Users;

class InvoicesController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('管理您的发票');
        
        parent::initialize();
    }
    
    public function indexAction(): void
    {
    }
    
    public function profileAction(): void
    {
        $auth = $this->session->get('auth');
        
        $user = Users::findFirst($auth['id']);
        if (!$user) {
            $this->dispatcher->forward([
                'controller' => 'index',
                'action' => 'index'
            ]);
            
            return;
        }
        
        if (!$this->request->isPost()) {
            $this->tag->setDefault('name', $user->name);
            $this->tag->setDefault('email', $user->email);
        } else {
            $user->name = $this->request->getPost('name', ['string', 'striptags']);
            $user->email = $this->request->getPost('email', 'email');
            
            if (!$user->update()) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error($message->getMessage());
                }
            } else {
                $this->flash->success('您的个人资料信息已更新成功');
            }
        }
    }
}
