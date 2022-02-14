<?php
declare(strict_types=1);

namespace Invo\forms;

use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;

class ProductTypesForm extends Form
{
    /**
     * 初始化产品类型表单
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

        // 产品类型名称
        $name = new Text('name');
        $name->setLabel('类型名称');
        $name->setFilters(['striptags', 'string']);
        $name->addValidators([
            new PresenceOf([
                'message' => '类型名称为必填项'
            ])
        ]);

        $this->add($name);
    }
}
