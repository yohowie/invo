<?php
declare(strict_types=1);

namespace Invo\controllers;

use Invo\forms\ProductsForm;
use Invo\Models\products;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\NativeArray;
use Phalcon\Paginator\Adapter\QueryBuilder;

class ProductsController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();

        $this->tag->setTitle('管理您的产品');
    }

    /**
     * 首页
     *
     * @return void
     */
    public function IndexAction(): void
    {
        $this->view->form = new ProductsForm();
    }

    /**
     * 根据当前条件搜索产品
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
                products::class,
                $this->persistent->searchParams
            )->getParams();
        }

        $builder = $this->modelsManager->createBuilder()->from(products::class)
            ->where($parameters['conditions'] ?? '', $parameters['bind'] ?? []);

        $paginator = new QueryBuilder([
            'builder' => $builder,
            'limit' => 10,
            'page' => $this->request->getQuery('page', 'init', 1)
        ]);

        $this->view->page = $paginator->paginate();
    }

    /**
     * 显示创建新产品的表单
     *
     * @return void
     */
    public function newAction(): void
    {
        $this->view->form = new ProductsForm(null, ['edit' => true]);
    }

    /**
     * 根据产品 ID 编辑产品
     *
     * @param $id
     * @return void
     */
    public function editAction($id): void
    {
        $product = Products::findFirstById($id);
        if (!$product) {
            $this->flash->error('未找到产品');

            $this->dispatcher->forward([
                'controller' => 'products',
                'action' => 'index'
            ]);

            return ;
        }

        $this->view->form = new ProductsForm($product, ['edit' => true]);
    }

    /**
     * 创建新产品
     *
     * @return void
     */
    public function createAction(): void
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'products',
                'action' => 'index'
            ]);

            return ;
        }

        $form = new ProductsForm();
        $product = new products();

        if (!$form->isValid($this->request->getPost(), $product)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            $this->dispatcher->forward([
                'controller' => 'products',
                'action' => 'new'
            ]);

            return ;
        }

        $product->active = 1;
        if (!$product->save()) {
            foreach ($product->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            $this->dispatcher->forward([
                'controller' => 'products',
                'action' => 'new'
            ]);

            return ;
        }

        $form->clear();
        $this->flash->success('产品创建成功');

        $this->dispatcher->forward([
            'controller' => 'products',
            'action' => 'index'
        ]);
    }

    /**
     * 保存产品信息
     *
     * @return void
     */
    public function saveAction(): void
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'products',
                'action' => 'index'
            ]);

            return ;
        }

        $id = $this->request->getPost('id', 'int');
        $product = products::findFirstById($id);
        if (!$product) {
            $this->flash->error('产品不存在');

            $this->dispatcher->forward([
                'controller' => 'products',
                'action' => 'index'
            ]);

            return ;
        }

        $form = new ProductsForm();
        if (!$form->isValid($this->request->getPost(), $product)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            $this->dispatcher->forward([
                'controller' => 'products',
                'action' => 'edit',
                'params' => [$id]
            ]);

            return ;
        }

        if (!$product->save()) {
            foreach ($product->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            $this->dispatcher->forward([
                'controller' => 'products',
                'action' => 'edit',
                'params' => [$id]
            ]);

            return ;
        }

        $form->clear();
        $this->flash->success('产品编辑成功');

        $this->dispatcher->forward([
            'controller' => 'products',
            'action' => 'index'
        ]);
    }

    /**
     * 删除产品
     *
     * @param $id
     * @return void
     */
    public function deleteAction($id): void
    {
        $product = products::findFirstById($id);
        if (!$product) {
            $this->flash->error('未找到产品');

            $this->dispatcher->forward([
                'controller' => 'products',
                'action' => 'index'
            ]);

            return ;
        }

        if (!$product->delete()) {
            foreach ($product->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            $this->dispatcher->forward([
                'controller' => 'products',
                'action' => 'search'
            ]);

            return ;
        }

        $this->flash->success('产品删除成功');

        $this->dispatcher->forward([
            'controller' => 'products',
            'action' => 'index'
        ]);
    }
}
