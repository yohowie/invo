<?php
declare(strict_types=1);

namespace Invo\Forms;

use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;

class CompaniesForm extends Form
{
    public function initialize($entity = null, array $options = [])
    {
        if (!isset($options['edit'])) {
            $this->add((new Text('id'))->setLabel('Id'));
        } else {
            $this->add(new Hidden('id'));
        }
        
        $commonFilters = ['striptags', 'string'];
        
        // Name text field
        $name = new Text('name');
        $name->setLabel('公司名称');
        $name->setFilters($commonFilters);
        $name->addValidators([
            new PresenceOf(['message' => '公司名称为必填项'])
        ]);
        $this->add($name);
        
        // Telephone text field
        $telephone = new Text('telephone');
        $telephone->setLabel('公司电话');
        $telephone->setFilters($commonFilters);
        $telephone->addValidators([
            new PresenceOf(['message' => '公司电话为必填项'])
        ]);
        $this->add($telephone);
        
        // Address text field
        $address = new Text('address');
        $address->setLabel('公司地址');
        $address->setFilters($commonFilters);
        $address->addValidators([
            new PresenceOf(['message' => '公司地址为必填项'])
        ]);
        $this->add($address);
        
        // City text field
        $city = new Text('city');
        $city->setLabel('城市');
        $city->setFilters($commonFilters);
        $city->addValidators([
            new PresenceOf(['message' => '城市为必填项'])
        ]);
        $this->add($city);
    }
}
