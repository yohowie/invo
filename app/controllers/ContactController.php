<?php
declare(strict_types=1);

namespace Invo\Controllers;

use Invo\Forms\ContactForm;
use Invo\Models\Contact;

class ContactController extends ControllerBase
{
    public function initialize(): void
    {
        parent::initialize();

        $this->tag->setTitle('');
    }

    public function indexAction(): void
    {
        $this->view->form = new ContactForm();
    }

    public function sendAction(): void
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => 'contact',
                'action' => 'index'
            ]);

            return ;
        }

        $form = new ContactForm();
        $contact = new Contact();

        if (!$form->isValid($this->request->getPost(), $contact)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            $this->dispatcher->forward([
                'controller' => 'contact',
                'action' => 'index'
            ]);

            return ;
        }

        if (!$contact->save()) {
            foreach ($contact->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            $this->dispatcher->forward([
                'controller' => 'contact',
                'action' => 'index'
            ]);

            return ;
        }

        $this->flash->success('谢谢，我们将在接下来的几个小时内与您联系');

        $this->dispatcher->forward([
            'controller' => 'index',
            'action' => 'index'
        ]);
    }
}
