<?php
declare(strict_types=1);

namespace Invo\Controllers;

use Invo\Controllers\ControllerBase;
use Invo\Forms\CompaniesForm;
use Invo\Models\Companies;
use Phalcon\Mvc\Model\Criteria;
use Nette\Utils\Paginator;

class CompaniesController extends ControllerBase
{
    public function initialize(): void
    {
        parent::initialize();
        
        $this->tag->setTitle('管理您的公司');
    }
    
    public function indexAction(): void
    {
        $this->view->form = new CompaniesForm();
    }
    
    public function searchAction(): void
    {
        if ($this->request->isGet()) {
            $query = Criteria::fromInput(
                $this->di, 
                Companies::class, 
                $this->request->get()
            );
            
            $this->persistent->searchParams = $query->getParams();
        }
        
        $parameters = [];
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }
        
        $companies = Companies::find($parameters);
        if (count($companies) == 0) {
            $this->flash->notice('未搜索到任何公司');
            
            $this->dispatcher->forward([
                'controller' => 'companies',
                'action'     => 'index'
            ]);
            
            return ;
        }
        
        $paginator = new Paginator([
            'data' => $companies,
            'limit' => 10,
            'page' => $this->request->getQuery('page', 'int', 1)
        ]);
        
        $this->view->page = $paginator->paginate();
        $this->view->companies = $companies;
    }
    
    public function newAction(): void
    {
        $this->view->form = new CompaniesForm(null, ['edit' => true]);
    }
    
    public function createAction(): void
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'companies',
                'action'     => 'index'
            ]);
            
            return ;
        }
        
        $form = new CompaniesForm();
        $company = new Companies();
        
        $data = $this->request->getPost();
        if (!$form->isValid($data, $company)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            
            $this->dispatcher->forward([
                'controller' => 'companies',
                'action'     => 'new'
            ]);
            
            return ;
        }
        
        if (!$company->save()) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            
            $this->dispatcher->forward([
                'controller' => 'companies',
                'action'     => 'new'
            ]);
            
            return ;
        }
        
        $form->clear();
        $this->flash->success('公司创建成功');
        
        $this->dispatcher->forward([
            'controller' => 'companies',
            'action'     => 'index'
        ]);
    }
}
