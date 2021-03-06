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

namespace WellCommerce\Core\Layout\Column;

/**
 * Class LayoutColumnCollection
 *
 * @package WellCommerce\Core\Layout
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class LayoutColumnCollection implements \IteratorAggregate, \Countable
{
    public $columns = [];

    public function getIterator()
    {
        return new \ArrayIterator($this->columns);
    }

    public function count()
    {
        return count($this->columns);
    }

    public function add(LayoutColumn $column)
    {
        $this->columns[] = $column;
    }

    public function all()
    {
        return $this->columns;
    }
}