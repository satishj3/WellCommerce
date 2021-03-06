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
namespace WellCommerce\Plugin\Contact\DataGrid;

use WellCommerce\Core\DataGrid,
    WellCommerce\Core\DataGrid\DataGridInterface;
use WellCommerce\Plugin\Contact\Event\ContactDataGridEvent;

/**
 * Class ContactDataGrid
 *
 * @package WellCommerce\Plugin\Contact\DataGrid
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class ContactDataGrid extends DataGrid implements DataGridInterface
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setOptions([
            'id'             => 'contact',
            'event_handlers' => [
                'load'       => $this->getXajaxManager()->registerFunction(['LoadContact', $this, 'loadData']),
                'edit_row'   => 'editContact',
                'click_row'  => 'editContact',
                'delete_row' => $this->getXajaxManager()->registerFunction(['DeleteContact', $this, 'deleteRow'])
            ],
            'routes'         => [
                'edit' => $this->generateUrl('admin.contact.edit')
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->addColumn('id', [
            'source'     => 'contact.id',
            'caption'    => $this->trans('Id'),
            'sorting'    => [
                'default_order' => DataGridInterface::SORT_DIR_DESC
            ],
            'appearance' => [
                'width'   => 90,
                'visible' => false
            ],
            'filter'     => [
                'type' => DataGridInterface::FILTER_BETWEEN
            ]
        ]);

        $this->addColumn('name', [
            'source'     => 'contact_translation.name',
            'caption'    => $this->trans('Name'),
            'appearance' => [
                'width' => 70,
                'align' => DataGridInterface::ALIGN_LEFT
            ],
            'filter'     => [
                'type' => DataGridInterface::FILTER_INPUT
            ]
        ]);
        
        $this->query = $this->getDb()
            ->table('contact')
            ->join('contact_translation', 'contact_translation.contact_id', '=', 'contact.id')
            ->groupBy('contact.id');

        $event = new ContactDataGridEvent($this);

        $this->getDispatcher()->dispatch(ContactDataGridEvent::DATAGRID_INIT_EVENT, $event);
    }
}