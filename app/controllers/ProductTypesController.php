<?php
declare(strict_types=1);

namespace Invo\controllers;

use Invo\forms\ProductTypesForm;
use Invo\models\ProductTypes;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\NativeArray;

class ProductTypesController extends ControllerBase
{
    /**
     * 初始化
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->tag->setTitile = '管理您的产品类型';
    }

    /**
     * 首页
     *
     * @return void
     */
    public function indexAction(): void
    {
        $this->view->form = new ProductTypesForm();
    }

    /**
     * 搜索产品类型
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
                ProductTypes::class,
                $this->persistent->searchParams
            )->getParams();
        }

        $productTypes = ProductTypes::find($parameters);
        if (count($productTypes) === 0) {
            $this->flash->notice('没有搜索到任何类型');

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action' => 'index'
            ]);

            return ;
        }

        $paginator = new NativeArray([
            'data' => $productTypes->toArray(),
            'limit' => 10,
            'page' => $this->request->getQuery('page', 'int', 1)
        ]);

        $this->view->page = $paginator->paginate();
    }

    /**
     * 显示创建产品类型的表单
     *
     * @return void
     */
    public function newAction(): void
    {
        $this->view->form = new ProductTypesForm(null, ['edit' => true]);
    }

    /**
     * 编辑产品类型
     *
     * @param $id
     * @return void
     */
    public function editAction($id): void
    {
        $productTypes = ProductTypes::findFirstById($id);
        if (!$productTypes) {
            $this->flash->error('找不到要编辑的产品类型');

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action' => 'index'
            ]);

            return ;
        }

        $this->view->form = new ProductTypesForm($productTypes, ['edit' => true]);
    }

    /**
     * 创建产品类型
     *
     * @return void
     */
    public function createAction(): void
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action' => 'index'
            ]);

            return ;
        }

        $form = new ProductTypesForm();
        $productTypes = new ProductTypes();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $productTypes)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action' => 'new'
            ]);

            return ;
        }

        if (!$productTypes->save()) {
            foreach ($productTypes->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action' => 'new'
            ]);
        }

        $form->clear();
        $this->flash->success('产品类型创建成功');

        $this->dispatcher->forward([
            'controller' => 'producttypes',
            'action' => 'index'
        ]);
    }

    /**
     * 保存修改
     *
     * @return void
     */
    public function saveAction(): void
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action' => 'index'
            ]);

            return ;
        }

        $id = $this->request->getPost('id', 'int');
        $productTypes = ProductTypes::findFirstById($id);
        if (!$productTypes) {
            $this->flash->error('产品类型不存在');

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action' => 'index'
            ]);

            return ;
        }

        $form = new ProductTypesForm();
        if (!$form->isValid($this->request->getPost(), $productTypes)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action' => 'index'
            ]);

            return ;
        }

        if (!$productTypes->save()) {
            foreach ($productTypes->getMessage() as $message) {
                $this->flash->error((string) $message);
            }

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action' => 'index'
            ]);

            return ;
        }

        $form->clear();
        $this->flash->success('产品类型更新成功');

        $this->dispatcher->forward([
            'controller' => 'producttypes',
            'action' => 'index'
        ]);
    }

    /**
     * 删除产品类型
     *
     * @return void
     */
    public function deleteAction($id): void
    {
        $productTypes = ProductTypes::findFirstById($id);
        if (!$productTypes) {
            $this->flash->error('未找到产品类型');

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action' => 'index'
            ]);

            return ;
        }

        if (!$productTypes->delete()) {
            foreach ($productTypes->getMessage() as $message) {
                $this->flash->error((string) $message);
            }

            $this->dispatcher->forward([
                'controller' => 'producttypes',
                'action' => 'search'
            ]);

            return ;
        }

        $this->flash->success('产品类型已删除');

        $this->dispatcher->forward([
            'controller' => 'producttypes',
            'action' => 'search'
        ]);
    }
}
