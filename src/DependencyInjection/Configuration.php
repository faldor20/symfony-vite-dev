<?php

namespace Pentatrion\ViteBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('pentatrion_vite');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
        ->children()
            ->scalarNode('base')->defaultValue('/build/')->end()
            ->scalarNode('public_dir')->defaultValue('/public')->end()
            ->arrayNode('server')
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('host')->defaultValue('localhost')->end()
                ->integerNode('port')->defaultValue(5173)->end()
                ->booleanNode('https')->defaultFalse()->end()
            ->end()
            ->end()
            ->arrayNode('script_attributes')
                ->info('Key/value pair of attributes to render on all script tags')
                ->example('{ defer: true, referrerpolicy: "origin" }')
                ->normalizeKeys(false)
                ->scalarPrototype()->end()
            ->end()
            ->arrayNode('link_attributes')
                ->info('Key/value pair of attributes to render on all CSS link tags')
                ->example('{ referrerpolicy: "origin" }')
                ->normalizeKeys(false)
                ->scalarPrototype()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
