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

namespace WellCommerce\Core\Form\Elements;

/**
 * Class Combo
 *
 * @package WellCommerce\Core\Form\Elements
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class Combo extends OptionedField implements ElementInterface
{

    protected function prepareAttributesJs()
    {
        $attributes = Array(
            $this->formatAttributeJs('name', 'sName'),
            $this->formatAttributeJs('label', 'sLabel'),
            $this->formatAttributeJs('comment', 'sComment'),
            $this->formatAttributeJs('suffix', 'sSuffix'),
            $this->formatAttributeJs('prefix', 'sPrefix'),
            $this->formatAttributeJs('error', 'sError'),
            $this->formatAttributeJs('selector', 'sSelector'),
            $this->formatAttributeJs('css_attribute', 'sCssAttribute'),
            $this->formatRepeatableJs(),
            $this->formatRulesJs(),
            $this->formatDependencyJs(),
            $this->formatOptionsJs(),
            $this->formatDefaultsJs()
        );

        return $attributes;
    }

}
