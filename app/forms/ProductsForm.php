<?php
declare(strict_types=1);

namespace Invo\forms;

use Invo\models\ProductTypes;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Numericality;
use Phalcon\Validation\Validator\PresenceOf;

class ProductsForm extends Form
{
    /**
     * 创建产品表单
     *
     * @param $entity
     * @param array $options
     * @return void
     */
    public function initialize($entity = null, array $options = [])
    {
        if (!isset($options['edit'])) {
            $this->add((new Text('id'))->setLabel('Id'));
        } else {
            $this->add(new Hidden('id'));
        }

        // 产品名称字段
        $name = new Text('name');
        $name->setLabel('名称');
        $name->setFilters(['striptags', 'string']);
        $name->addValidators([
            new PresenceOf([
                'message' => '名称为必填项'
            ])
        ]);

        $this->add($name);

        // 产品类型字段
        $type = new Select('product_types_id', ProductTypes::find(), [
            'using' => ['id', 'name'],
            'useEmpty' => true,
            'emptyText' => '...',
            'emptyValue' => ''
        ]);
        $type->setLabel('类型');

        $this->add($type);

        // 价格字段
        $price = new Text('price');
        $price->setLabel('价格');
        $price->setFilters(['float']);
        $price->addValidators([
            new PresenceOf(['价格为必填项']),
            new Numericality(['价格为必填项'])
        ]);

        $this->add($price);
    }
}
