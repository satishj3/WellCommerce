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

namespace WellCommerce\Plugin\ShippingMethod\Calculator;


class FixedPriceCalculator extends Calculator
{
    public function getName()
    {
        return $this->trans('Fixed price');
    }

    public function getRange()
    {

    }

    public function calculate()
    {

    }

    public function calculateProduct()
    {

    }
} 