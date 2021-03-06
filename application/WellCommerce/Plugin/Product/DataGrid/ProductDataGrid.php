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
namespace WellCommerce\Plugin\Product\DataGrid;

use WellCommerce\Core\DataGrid,
    WellCommerce\Core\DataGrid\DataGridInterface;
use WellCommerce\Plugin\Product\Event\ProductDataGridEvent;

/**
 * Class ProductDataGrid
 *
 * @package WellCommerce\Plugin\Product\DataGrid
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class ProductDataGrid extends DataGrid implements DataGridInterface
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setOptions([
            'id'             => 'product',
            'event_handlers' => [
                'load'       => $this->getXajaxManager()->registerFunction(['LoadProduct', $this, 'loadData']),
                'delete_row' => $this->getXajaxManager()->registerFunction(['DeleteProduct', $this, 'deleteRow']),
                'edit_row'   => 'editProduct',
                'click_row'  => 'editProduct',
                'update_row' => $this->getXajaxManager()->registerFunction(['UpdateProduct', $this, 'updateRow']),
                'process'    => 'processProduct',
                'loaded'     => 'dataLoaded'
            ],
            'routes'         => [
                'index' => $this->generateUrl('admin.product.index'),
                'edit'  => $this->generateUrl('admin.product.edit')
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
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

        $this->addColumn('preview', [
            'source'           => 'product.photo_id',
            'caption'          => $this->trans('Thumb'),
            'sorting'          => [
                'default_order' => DataGridInterface::SORT_DIR_DESC
            ],
            'appearance'       => [
                'width'   => 90,
                'visible' => false
            ],
            'process_function' => function ($id) {
                    if ((int)$id == 0) {
                        return '';
                    }

                    return $this->getImageGallery()->getImageUrl($id, 100, 100);
                }
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

        $this->addColumn('category', [
            'source'     => 'GROUP_CONCAT(DISTINCT SUBSTRING(CONCAT(\' \', category_translation.name), 1))',
            'caption'    => $this->trans('Category'),
            'appearance' => [
                'width' => 120,
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
            ],
            'filter'     => [
                'type' => DataGridInterface::FILTER_BETWEEN
            ]
        ]);

        $this->query = $this->getDb()
            ->table('product')
            ->join('product_translation', 'product_translation.product_id', '=', 'product.id')
            ->leftJoin('product_category', 'product_category.product_id', '=', 'product.id')
            ->leftJoin('category_translation', 'category_translation.category_id', '=', 'product_category.category_id')
            ->groupBy('product.id');

        $event = new ProductDataGridEvent($this);

        $this->getDispatcher()->dispatch(ProductDataGridEvent::DATAGRID_INIT_EVENT, $event);
    }
}