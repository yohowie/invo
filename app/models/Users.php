<?php
declare(strict_types=1);

namespace Invo\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class Users extends Model
{
    public function validation()
    {
        $validator = new Validation();
        
        $validator->add('email', new EmailValidator([
            'message' => '提供的电子邮件无效 '
        ]));
        
        $validator->add('email', new UniquenessValidator([
            'message' => '抱歉，该邮箱已被其他用户注册'
        ]));
        
        $validator->add('username', new UniquenessValidator([
            'message' => '抱歉，用户名已被注册'
        ]));
        
        return $this->validate($validator);
    }
}
