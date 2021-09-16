<?php
declare(strict_types=1);

namespace Invo\Forms;

use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class RegisterForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        // name text field
        $name = new Text('name');
        $name->setLabel('你的全名');
        $name->setFilters(['striptags', 'string']);
        $name->addValidators([
            new PresenceOf(['message' => '姓名为必填项'])
        ]);
        
        $this->add($name);
        
        // username text field
        $username = new Text('username');
        $username->setLabel('用户名');
        $username->setFilters(['alpha']);
        $username->addValidators([
            new PresenceOf(['message' => '请输入您想要的用户名'])
        ]);
        
        $this->add($username);
        
        // Email text field
        $email = new Text('email');
        $email->setLabel('电子邮箱');
        $email->setFilters('email');
        $email->addValidators([
            new PresenceOf(['message' => '需要电子邮件']),
            new Email(['message' => '电子邮件无效'])
        ]);
        
        $this->add($email);
        
       // password field
       $password = new Password('password');
       $password->setLabel('密码');
       $password->addValidators([
           new PresenceOf(['message' => '密码是必需的'])
       ]);
       
       $this->add($password);
       
       // confire password field
       $repeatPassword = new Password('repeatPassword');
       $repeatPassword->setLabel('确认密码');
       $repeatPassword->addValidators([
           new PresenceOf(['message' => '需要确认密码'])
       ]);
       
       $this->add($repeatPassword);
    }
}
