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
namespace WellCommerce\Core\Migration;

use WellCommerce\Core\Migration;

/**
 * Migration1395612455
 *
 * This class has been auto-generated
 * by the WellCommerce Console migrate:add command
 */
class Migration1395612455 extends Migration implements MigrationInterface
{
    public function up()
    {
        if (!$this->getDb()->schema()->hasTable('client_group')) {
            $this->getDb()->schema()->create('client_group', function ($table) {
                $table->increments('id');
                $table->decimal('discount', 15, 4)->default(0);
                $table->timestamps();
            });
        }

        if (!$this->getDb()->schema()->hasTable('client_group_translation')) {
            $this->getDb()->schema()->create('client_group_translation', function ($table) {
                $table->increments('id');
                $table->string('name', 255);
                $table->integer('client_group_id')->unsigned();
                $table->integer('language_id')->unsigned();
                $table->timestamps();
                $table->foreign('client_group_id')->references('id')->on('client_group')->onDelete('CASCADE')->onUpdate('NO ACTION');
                $table->foreign('language_id')->references('id')->on('language')->onDelete('CASCADE')->onUpdate('NO ACTION');
            });
        }

        if (!$this->getDb()->schema()->hasTable('layout_theme')) {
            $this->getDb()->schema()->create('layout_theme', function ($table) {
                $table->increments('id');
                $table->string('name', 255);
                $table->string('folder', 255);
                $table->timestamps();
            });
        }

        if (!$this->getDb()->schema()->hasTable('layout_theme_css')) {
            $this->getDb()->schema()->create('layout_theme_css', function ($table) {
                $table->increments('id');
                $table->string('class', 255);
                $table->string('selector', 255);
                $table->string('attribute', 255);
                $table->integer('layout_theme_id')->unsigned();
                $table->timestamps();
                $table->foreign('layout_theme_id')->references('id')->on('layout_theme')->onDelete('CASCADE')->onUpdate('NO ACTION');
            });
        }

//        $this->getDb()->schema()->table('shop', function ($table) {
//            $table->integer('layout_theme_id')->nullable()->unsigned()->after('company_id');
//            $table->foreign('layout_theme_id')->references('id')->on('layout_theme')->onDelete('SET NULL')->onUpdate('NO ACTION');
//        });
    }

    public function down()
    {

    }
}