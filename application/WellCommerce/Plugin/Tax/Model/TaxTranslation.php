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
namespace WellCommerce\Plugin\Tax\Model;

use WellCommerce\Core\Model;

/**
 * Class TaxTranslation
 *
 * @package WellCommerce\Plugin\Tax\Model
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class TaxTranslation extends Model
{

    protected $table = 'tax_translation';

    public $timestamps = true;

    protected $softDelete = false;
    
    protected $fillable = ['tax_id', 'language_id', 'name'];

    public function tax()
    {
        return $this->belongsTo('WellCommerce\Plugin\Tax\Model\Tax');
    }

    public function language()
    {
        return $this->belongsTo('WellCommerce\Plugin\Tax\Model\Language');
    }
}