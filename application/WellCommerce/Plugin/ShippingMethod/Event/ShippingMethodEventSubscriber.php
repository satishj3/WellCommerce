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
namespace WellCommerce\Plugin\ShippingMethod\Event;

use Symfony\Component\EventDispatcher\Event,
    Symfony\Component\EventDispatcher\EventSubscriberInterface;

use WellCommerce\Plugin\AdminMenu\Event\AdminMenuInitEvent;

/**
 * Class ShippingMethodEventSubscriber
 *
 * @package WellCommerce\Plugin\ShippingMethod\Event
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class ShippingMethodEventSubscriber implements EventSubscriberInterface
{

    public function onAdminMenuInitAction(Event $event)
    {
    }

    public function onShippingMethodDataGridInitAction(Event $event)
    {
    }

    public static function getSubscribedEvents()
    {
        return array(
            AdminMenuInitEvent::ADMIN_MENU_INIT_EVENT => 'onAdminMenuInitAction',
            ShippingMethodDataGridEvent::DATAGRID_INIT_EVENT => 'onShippingMethodDataGridInitAction'
        );
    }
}