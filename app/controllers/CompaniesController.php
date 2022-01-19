<?php
declare(strict_types=1);

namespace Invo\Controllers;

use Invo\Forms\CompaniesForm;
use Invo\Models\Companies;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\NativeArray;

class CompaniesController extends ControllerBase
{
    /**
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->tag->setTitle('管理您的公司');
    }

    /**
     * @return void
     */
    public function indexAction(): void
    {
        $this->view->form = new CompaniesForm();
    }

    /**
     * 搜索公司
     *
     * @return void
     */
    public function searchAction(): void
    {
        if ($this->request->isPost()) {
            $this->persistent->searchParams = $this->request->getPost();
        }

        $parameters = [];
        if ($this->persistent->searchParams) {
            $parameters = Criteria::fromInput(
                $this->di,
                Companies::class,
                $this->persistent->searchParams
            )->getParams();
        }

        $companies = Companies::find($parameters);
        if (count($companies) == 0) {
            $this->flash->notice('没有搜索到任何公司');

            $this->dispatcher->forward([
                'controller' => 'companies',
                'action' => 'index'
            ]);

            return;
        }

        $paginator = new NativeArray([
            'data' => $companies->toArray(),
            'limit' => 10,
            'page' => $this->request->getQuery('page', 'int', 1)
        ]);

        $this->view->page = $paginator->paginate();
    }

    /**
     * 显示创建公司的表单
     *
     * @return void
     */
    public function newAction(): void
    {
        $this->view->form = new CompaniesForm(null, ['edit' => true]);
    }

    /**
     * 编辑公司
     *
     * @param $id
     * @return void
     */
    public function editAction($id): void
    {
        $company = Companies::findFirstById($id);
        if (!$company) {
            $this->flash->error('没有这个公司');

            $this->dispatcher->forward([
                'controller' => 'companies',
                'action' => 'index'
            ]);

            return;
        }

        $this->view->form = new CompaniesForm($company, ['edit' => true]);
    }

    /**
     * 创建一个新的公司
     *
     * @return void
     */
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

    /**
     * 保存公司
     *
     * @return void
     */
    public function saveAction(): void
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'companies',
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost('id', 'int');
        $company = Companies::findFirstById($id);
        if (!$company) {
            $this->flash->error('公司不存在');

            $this->dispatcher->forward([
                'controller' => 'companies',
                'action' => 'index'
            ]);

            return;
        }

        $data = $this->request->getPost();
        $form = new CompaniesForm();
        if (!$form->isValid($data, $company)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            $this->dispatcher->forward([
                'controller' => 'companies',
                'action' => 'index'
            ]);

            return;
        }

        if (!$company->save()) {
            foreach ($company->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            $this->dispatcher->forward([
                'controller' => 'companies',
                'action' => 'index'
            ]);

            return;
        }

        $form->clear();
        $this->flash->success('公司更新成功');

        $this->dispatcher->forward([
            'controller' => 'companies',
            'action' => 'index'
        ]);
    }

    /**
     * 删除公司
     *
     * @param int $id
     * @return void
     */
    public function deleteAction(int $id): void
    {
        $company = Companies::findFirstById($id);
        if (!$company) {
            $this->flash->error('找不到公司');

            $this->dispatcher->forward([
                'controller' => 'companies',
                'action' => 'index'
            ]);

            return ;
        }

        if (!$company->delete()) {
            foreach ($company->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            $this->dispatcher->forward([
                'controller' => 'companies',
                'action' => 'search'
            ]);

            return ;
        }

        $this->flash->success('公司删除成功');

        $this->dispatcher->forward([
            'controller' => 'companies',
            'action' => 'index'
        ]);
    }
}
