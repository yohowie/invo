<?php
declare(strict_types=1);

namespace Invo\models;

use Invo\forms\ProductsForm;
use Phalcon\Mvc\Model;

class ProductTypes extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    public function initialize()
    {
        $this->hasMany('id', ProductsForm::class, 'product_types_id', [
            'foreignKey' => [
                'message' => '无法删除产品类型，因为它在产品中使用'
            ]
        ]);
    }
}
