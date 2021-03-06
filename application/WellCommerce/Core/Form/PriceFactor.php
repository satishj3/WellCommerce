<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\Core\Form;

/**
 * Class PriceFactor
 *
 * @package WellCommerce\Core\Form
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class PriceFactor
{

    protected $_type;

    protected $_value;

    const TYPE_PERCENTAGE = 'GPriceFactor.TYPE_PERCENTAGE';
    const TYPE_ADD        = 'GPriceFactor.TYPE_ADD';
    const TYPE_SUBTRACT   = 'GPriceFactor.TYPE_SUBTRACT';
    const TYPE_EQUALS     = 'GPriceFactor.TYPE_EQUALS';

    public function __construct($type, $value)
    {
        $this->_type  = $type;
        $this->_value = $value;
    }

    public function render()
    {
        return "new GPriceFactor({$this->_type}, {$this->_value})";
    }
}
