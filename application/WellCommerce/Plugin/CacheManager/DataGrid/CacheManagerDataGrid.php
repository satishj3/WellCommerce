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
namespace WellCommerce\Plugin\CacheManager\DataGrid;

use WellCommerce\Core\DataGrid,
    WellCommerce\Core\DataGrid\DataGridInterface;

/**
 * Class CacheManagerDataGrid
 *
 * @package WellCommerce\Plugin\CacheManager\DataGrid
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class CacheManagerDataGrid extends DataGrid implements DataGridInterface
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->setOptions([
            'id'             => 'product',
            'appearance'     => [
                'column_select' => false
            ],
            'mechanics'      => [
                'key' => 'id',
            ],
            'event_handlers' => [
                'load'       => $this->getXajaxManager()->registerFunction(['loadProduct', $this, 'getData']),
                'edit_row'   => $this->getXajaxManager()->registerFunction(['editProduct', $this, 'editProduct']),
                'delete_row' => $this->getXajaxManager()->registerFunction(['deleteProduct', $this, 'delete']),
                'update_row' => $this->getXajaxManager()->registerFunction(['updateProduct', $this, 'updateProduct']),
            ],
        ]);

        $this->addColumn('id', [
            'source'     => 'product.id',
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
            'source'     => 'product_translation.name',
            'caption'    => $this->trans('Name'),
            'appearance' => [
                'width' => 70,
                'align' => DataGridInterface::ALIGN_LEFT
            ],
            'filter'     => [
                'type' => DataGridInterface::FILTER_INPUT
            ]
        ]);

        $this->addColumn('sku', [
            'source'     => 'product.sku',
            'caption'    => $this->trans('SKU'),
            'appearance' => [
                'width' => 20,
            ],
            'filter'     => [
                'type' => DataGridInterface::FILTER_INPUT
            ]
        ]);

        $this->addColumn('ean', [
            'source'     => 'product.ean',
            'caption'    => $this->trans('EAN'),
            'editable'   => true,
            'appearance' => [
                'width' => 60,
                'align' => DataGridInterface::ALIGN_RIGHT
            ],
            'filter'     => [
                'type' => DataGridInterface::FILTER_INPUT
            ]
        ]);

        $this->addColumn('sell_price', [
            'source'     => 'product.sell_price',
            'caption'    => $this->trans('Price net'),
            'editable'   => true,
            'appearance' => [
                'width' => 40,
                'align' => DataGridInterface::ALIGN_RIGHT
            ],
            'filter'     => [
                'type' => DataGridInterface::FILTER_BETWEEN
            ]
        ]);

        $this->addColumn('sell_price_gross', [
            'source'     => 'product.sell_price',
            'caption'    => $this->trans('Price gross'),
            'editable'   => true,
            'appearance' => [
                'width' => 40,
                'align' => DataGridInterface::ALIGN_RIGHT
            ],
            'filter'     => [
                'type' => DataGridInterface::FILTER_BETWEEN
            ]
        ]);

        $this->addColumn('stock', [
            'source'     => 'product.stock',
            'caption'    => $this->trans('Stock'),
            'editable'   => true,
            'appearance' => [
                'width' => 40,
                'align' => DataGridInterface::ALIGN_RIGHT
            ],
            'filter'     => [
                'type' => DataGridInterface::FILTER_BETWEEN
            ]
        ]);

        $this->addColumn('hierarchy', [
            'source'     => 'product.hierarchy',
            'caption'    => $this->trans('Hierarchy'),
            'editable'   => true,
            'appearance' => [
                'width' => 40,
                'align' => DataGridInterface::ALIGN_RIGHT
            ],
            'filter'     => [
                'type' => DataGridInterface::FILTER_BETWEEN
            ]
        ]);

        $this->addColumn('weight', [
            'source'     => 'product.weight',
            'caption'    => $this->trans('Weight'),
            'editable'   => true,
            'appearance' => [
                'width' => 40,
                'align' => DataGridInterface::ALIGN_RIGHT
            ],
            'filter'     => [
                'type' => DataGridInterface::FILTER_BETWEEN
            ]
        ]);

        $this->query = $this->getDb()
            ->table('product')
            ->join('product_translation', 'product_translation.product_id', '=', 'product.id')
            ->groupBy('product.id');

        $event = new ProductDataGridEvent($this);

        $this->getDispatcher()->dispatch(ProductDataGridEvent::DATAGRID_INIT_EVENT, $event);

        $this->registerEventHandlers();

        $this->addColumn('id', [
            'source' => 'cache_manager.id'
        ]);

        $this->addColumn('name', [
            'source' => 'cache_manager_translation.name'
        ]);

        $this->query = $this->getDb()
            ->table('cache_manager')
            ->join('cache_manager_translation', 'cache_manager_translation.cache_manager_id', '=', 'cache_manager.id')
            ->groupBy('cache_manager.id');
    }

    /**
     * {@inheritdoc}
     */
    public function registerEventHandlers()
    {
        $this->getXajaxManager()->registerFunctions([
            'getCacheManagerForAjax' => [$this, 'getData'],
            'doDeleteCacheManager'   => [$this, 'delete']
        ]);
    }
}