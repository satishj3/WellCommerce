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
 * Class LayoutBoxSchemePreview
 *
 * @package WellCommerce\Core\Form\Elements
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class LayoutBoxSchemePreview extends Field implements ElementInterface
{

    public function __construct($attributes)
    {
        parent::__construct($attributes);
        if (!isset($this->attributes['name'])) {
            $this->attributes['name'] = 'LayoutBoxSchemePreview_' . $this->_id;
        }
        if (isset($this->attributes['layout_box_tpl']) && is_file($this->attributes['layout_box_tpl'])) {
            $this->attributes['layout_box_tpl'] = file_get_contents($this->attributes['layout_box_tpl']);
        }
    }

    protected function prepareAttributesJs()
    {
        $attributes = Array(
            $this->formatAttributeJs('name', 'sName'),
            $this->formatAttributeJs('triggers', 'asTriggers'),
            $this->formatAttributeJs('layout_box_tpl', 'sLayoutBoxTpl'),
            $this->formatAttributeJs('box_scheme', 'sBoxScheme'),
            $this->formatAttributeJs('box_name', 'sBoxName'),
            $this->formatAttributeJs('box_title', 'sBoxTitle'),
            $this->formatAttributeJs('box_content', 'sBoxContent'),
            $this->formatAttributeJs('stylesheets', 'asStylesheets'),
            $this->formatDependencyJs()
        );

        return $attributes;
    }

    public function renderStatic()
    {
    }

    public function populate($value)
    {
    }
}
