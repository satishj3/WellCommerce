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
namespace WellCommerce\Plugin\Layout\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use WellCommerce\Plugin\AdminMenu\Event\AdminMenuInitEvent;

/**
 * Class LayoutPageEventSubscriber
 *
 * @package WellCommerce\Plugin\LayoutPage\Event
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class LayoutPageEventSubscriber implements EventSubscriberInterface
{
    public function onAdminMenuInitAction(Event $event)
    {

    }

    public static function getSubscribedEvents()
    {
        return array(
            AdminMenuInitEvent::ADMIN_MENU_INIT_EVENT => 'onAdminMenuInitAction'
        );
    }
}