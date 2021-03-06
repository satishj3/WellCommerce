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
namespace WellCommerce\Plugin\Company\Model;

use WellCommerce\Core\Model;

/**
 * Class Company
 *
 * @package WellCommerce\Plugin\Company\Model
 * @author  Adam Piotrowski <adam@gekosale.com>
 */
class Company extends Model
{

    protected $table = 'company';

    public $timestamps = true;

    protected $softDelete = false;

    protected $fillable = ['id'];

    /**
     * Relation with Shop model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shop()
    {
        return $this->hasMany('WellCommerce\Plugin\Shop\Model\Shop');
    }
}