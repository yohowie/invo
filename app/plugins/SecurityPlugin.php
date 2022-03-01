<?php
declare(strict_types=1);

namespace Invo\Plugins;

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Component;
use Phalcon\Acl\Enum;
use Phalcon\Acl\Role;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

class SecurityPlugin extends Injectable
{
    /**
     * 此操作在执行应用程序中的任何操作之前执行
     * 
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @return boolean
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        $auth = $this->session->get('auth');
        if (!$auth) {
            $role = 'Guests';
        } else {
            $role = 'Users';
        }
        
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();
        
        $acl = $this->getAcl();
        
        if (!$acl->isComponent($controller)) {
            $dispatcher->forward([
                'controller' => 'errors',
                'action' => 'show404'
            ]);
            
            return false;
        }
        
        $allowed = $acl->isAllowed($role, $controller, $action);
        if (!$allowed) {
            $dispatcher->forward([
                'controller' => 'errors',
                'action' => 'show401'
            ]);
            
            $this->session->destroy();
            
            return false;
        }
        
        return true;
    }
    
    /**
     * 返回现有的或新的访问控制列表
     * 
     * @return AclList
     */
    protected function getAcl(): AclList
    {
        if (isset($this->persistent->acl)) {
            return $this->persistent->acl;
        }
        
        $acl = new AclList();
        $acl->setDefaultAction(Enum::DENY);
        
        // 注册角色
        $roles = [
            'users' => new Role('Users', '会员特权，登录后授予。'),
            'guests' => new Role('Guests', '浏览该网站但未登录的任何人都被视为“访客”。')
        ];
        foreach ($roles as $role) {
            $acl->addRole($role);
        }
        
        // 私有资源
        $privateResources = [
            'companies'    => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
            'products'     => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
            'producttypes' => ['index', 'search', 'new', 'edit', 'save', 'create', 'delete'],
            'invoices'     => ['index', 'profile']
        ];
        foreach ($privateResources as $resource => $action) {
            $acl->addComponent(new Component($resource), $action);
        }
        
        // 共有资源
        $publicResources = [
            'index'    => ['index'],
            'about'    => ['index'],
            'register' => ['index'],
            'errors'   => ['show401', 'show404', 'show500'],
            'session'  => ['index', 'register', 'start', 'end'],
            'contact'  => ['index', 'send']
        ];
        foreach ($publicResources as $resource => $action) {
            $acl->addComponent(new Component($resource), $action);
        }
        
        // 授予用户和访客访问公共区域的权限
        foreach ($roles as $role) {
            foreach ($publicResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow($role->getName(), $resource, $action);
                }
            }
        }
        
        // 将私有区域的访问权限授予角色用户
        foreach ($privateResources as $resource => $actions) {
            foreach ($actions as $action) {
                $acl->allow('Users', $resource, $action);
            }
        }
        
        // acl 存储在会话中
        $this->persistent->acl = $acl;
        
        return $acl;
    }
}
