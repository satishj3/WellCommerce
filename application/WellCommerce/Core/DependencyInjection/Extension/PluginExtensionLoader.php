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
namespace WellCommerce\Core\DependencyInjection\Extension;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class PluginExtensionLoader
 *
 * Scans all application directories for extensions and registers them in container
 *
 * @package WellCommerce\Core\DependencyInjection\Extension
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class PluginExtensionLoader
{

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    protected $containerBuilder;

    public function __construct (ContainerBuilder $containerBuilder)
    {
        $this->containerBuilder = $containerBuilder;
    }

    public function registerExtensions ()
    {
        $finder = $this->containerBuilder->get('finder');
        
        $files = $finder->files()->in(ROOTPATH . 'application')->name('*Extension.php');
        
        foreach ($files as $file){
            $namespace = $file->getRelativePath();
            $class = $namespace . '\\' . $file->getBasename('.php');
            
            $extension = new $class();
            if ($extension instanceof Extension){
                $this->containerBuilder->registerExtension($extension);
                $this->containerBuilder->loadFromExtension($extension->getAlias());
            }
        }
    }
}