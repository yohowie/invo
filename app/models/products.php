<?php
declare(strict_types=1);

namespace Invo\Models;

use Phalcon\Mvc\Model;

class products extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $product_types_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $price;

    /**
     * @var integer
     */
    public $active;

    /**
     * Products initializer
     *
     * @return void
     */
    public function initialize() {
        $this->belongsTo('product_types_id', ProductTypes::class, 'id', [
            'reusable' => true,
            'alias' => 'productTypes'
        ]);
    }

    public function getActiveDetail()
    {
        return $this->active == 'Y' ? '是' : '否';
    }
}
