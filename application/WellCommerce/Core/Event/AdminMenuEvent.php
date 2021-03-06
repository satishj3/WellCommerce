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
namespace WellCommerce\Core\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class FormEvent
 *
 * @package WellCommerce\Core\Event
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class AdminMenuEvent extends Event
{

    protected $menuData = Array();

    /**
     * Constructor
     *
     * @param Form $form
     */
    public function __construct ($menuData)
    {
        $this->menuData = $menuData;
    }

    /**
     * Returns an array containing current menu data
     *
     * @return array
     */
    public function getMenuData ()
    {
        return $this->menuData;
    }

    /**
     * Appends data to menu
     *
     * @param array $Data
     *
     * @return void
     */
    public function setMenuData (array $Data)
    {
        $this->menuData = array_merge_recursive($this->menuData, $Data);
    }
}