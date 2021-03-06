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

namespace WellCommerce\Core\Form\Rules;

use WellCommerce\Core\Rules\RuleInterface;
use WellCommerce\Core\Form\Rule;
use WellCommerce\Core\Elements\Field;

/**
 * Class DateTo
 *
 * @package WellCommerce\Core\Form\Rules
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class DateTo extends Rule implements RuleInterface
{
    protected $_compareWith;

    public function __construct($errorMsg, Field $compareWith)
    {
        parent::__construct($errorMsg);
        $this->_compareWith = $compareWith;
    }

    protected function checkValue($value)
    {
        if (strlen($value) > 0 && strlen($this->_compareWith->getValue()) > 0) {
            return ($value >= $this->_compareWith->getValue());
        }

        return true;
    }

    public function render()
    {
        $errorMsg = addslashes($this->_errorMsg);
        $field    = addslashes($this->_compareWith->getName());

        return "{sType: '{$this->getType()}', sErrorMessage: '{$errorMsg}', sFieldToCompare: '{$field}'}";
    }
}
