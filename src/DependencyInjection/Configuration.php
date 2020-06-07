<?php

declare(strict_types=1);

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\DocumenterBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /** @psalm-suppress PossiblyUndefinedMethod */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        /** @psalm-suppress TooManyArguments */
        $treeBuilder = new TreeBuilder('endroid_documenter');

        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            /** @psalm-suppress UndefinedMethod */
            $rootNode = $treeBuilder->root('endroid_documenter');
        }

        $rootNode
            ->children()
                ->scalarNode('name')->defaultValue('Project Documentation')->end()
        ;

        return $treeBuilder;
    }
}
