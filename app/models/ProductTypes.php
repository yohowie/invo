<?php
declare(strict_types=1);

namespace Invo\models;

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
        
    }
}
