<?php
declare(strict_types=1);

namespace Invo\Forms;

use Phalcon\Forms\Element\Email as FormEmail;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class ContactForm extends Form
{
    public function initialize($entity = null, array $options = [])
    {
        // 您的名字字段
        $name = new Text('name');
        $name->setLabel('您的名字');
        $name->setFilters(['striptags', 'string']);
        $name->addValidators([
            new PresenceOf([
                'message' => '名字为必填项'
            ])
        ]);

        $this->add($name);

        // 邮箱字段
        $email = new FormEmail('email');
        $email->setLabel('电子邮箱');
        $email->setFilters('email');
        $email->addValidators([
            new PresenceOf([
                'message' => '电子邮箱为必填项'
            ]),
            new Email([
                'message' => '电子邮箱无效'
            ])
        ]);

        $this->add($email);

        // 评论字段
        $comments = new TextArea('comments');
        $comments->setLabel('评论');
        $comments->setFilters(['striptags', 'string']);
        $comments->addValidators([
            new PresenceOf([
                'message' => '评论为必填项'
            ])
        ]);

        $this->add($comments);
    }
}
