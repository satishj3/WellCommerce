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
 * Class Option
 *
 * @package WellCommerce\Core\Form
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class Option
{

    public $value;

    public $label;

    public function __construct($value, $label)
    {
        $this->value = $value;
        $this->label = $label;
    }

    public static function make($array, $default = '')
    {
        $result = Array();
        if ($default && is_array($default)) {
            $result[] = new self('', $default[0]);
        }
        foreach ($array as $key => $value) {
            $result[] = new self($key, $value);
        }

        return $result;
    }

    public function __toString()
    {
        $value = addslashes($this->value);
        $label = addslashes($this->label);

        return "{sValue: '{$value}', sLabel: '{$label}'}";
    }
}
