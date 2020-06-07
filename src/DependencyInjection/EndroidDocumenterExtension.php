<?php

declare(strict_types=1);

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\DocumenterBundle\DependencyInjection;

use Endroid\Documenter\UmlDiagram\UmlDiagramBuilderInterface;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class EndroidDocumenterExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = $this->getConfiguration($configs, $container);

        if (!$configuration instanceof ConfigurationInterface) {
            throw new \Exception('Configuration not found');
        }

        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

        $definition = $container->findDefinition(UmlDiagramBuilderInterface::class);

        if (0 === count($config['paths'])) {
            $config['paths'] = [$container->getParameter('kernel.project_dir').'/src/'];
        }

        foreach ($config['paths'] as $path) {
            $definition->addMethodCall('addPath', [$path]);
        }

        if (0 === count($config['whitelist'])) {
            $config['whitelist'] = ['App\\'];
        }

        foreach ($config['whitelist'] as $whitelist) {
            $definition->addMethodCall('addWhitelist', [$whitelist]);
        }
    }
}
