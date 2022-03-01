<?php
declare(strict_types=1);
namespace Invo\Plugins;

use Exception;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatcherException;

class NotFoundPlugin extends Injectable
{
    public function beforeException(Event $event, MvcDispatcher $dispatcher, Exception $exception)
    {
        error_log($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
        
        if ($exception instanceof DispatcherException) {
            switch ($exception->getCode()) {
                case DispatcherException::EXCEPTION_HANDLER_NOT_FOUND:
                case DispatcherException::EXCEPTION_ACTION_NOT_FOUND:
                    $dispatcher->forward([
                        'controller' => 'errors',
                        'action' => 'show404'
                    ]);

                    return false;
            }
        }
        
        if ($dispatcher->getControllerName() !== 'errors') {
            $dispatcher->forward([
                'controller' => 'errors',
                'action' => 'show500'
            ]);
        }

        return !$event->isStopped();
    }
}
