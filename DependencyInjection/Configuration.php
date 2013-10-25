<?php

/*
 * This file is part of the Scar EpicEditor package.
 *
 * (c) Benjamin Lazarecki <benjamin.lazarecki@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Scar\EpicEditorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Scar epic editor configuration.
 *
 * @author Benjamin Lazarecki <benjamin.lazarecki@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('scar_epic_editor')->addDefaultsIfNotSet();
        $configsNode = $rootNode->children()->arrayNode('config')->addDefaultsIfNotSet();

        $this->getClassNodeDefinition($rootNode);

        $this->getBaseNodeDefinition($configsNode);
        $this->getFileNodeDefinition($configsNode);
        $this->getThemeNodeDefinition($configsNode);
        $this->getButtonNodeDefinition($configsNode);
        $this->getShortcutNodeDefinition($configsNode);
        $this->getStringNodeDefinition($configsNode);

        return $treeBuilder;
    }

    /**
     * Gets the class node definition.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The root node definition.
     *
     * @return \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition The node definition.
     */
    protected function getClassNodeDefinition(ArrayNodeDefinition $node)
    {
        return $node
            ->children()
                ->scalarNode('class')
                    ->defaultValue('Scar\EpicEditorBundle\Form\Type\EpicEditorType')
                ->end()
                ->scalarNode('js_path')
                    ->defaultValue('bundles/scarepiceditor/js/epiceditor.min.js')
                ->end()
            ->end();
    }

    /**
     * Gets the base node definition.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The config node definition.
     *
     * @return \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition The node definition.
     */
    protected function getBaseNodeDefinition(ArrayNodeDefinition $node)
    {
        return $node
            ->children()
                ->scalarNode('container')
                    ->defaultValue('epiceditor')
                ->end()
                ->scalarNode('textarea')
                  ->defaultNull()
                ->end()
                ->scalarNode('base_path')
                    ->defaultValue('/bundles/scarepiceditor')
                ->end()
                ->booleanNode('client_side_storage')
                    ->defaultTrue()
                ->end()
                ->scalarNode('local_storage_name')
                    ->defaultValue('epiceditor')
                ->end()
                ->booleanNode('use_native_fullsreen')
                    ->defaultTrue()
                ->end()
                ->scalarNode('parser')
                    ->defaultValue('marked')
                ->end()
                ->booleanNode('focus_on_load')
                    ->defaultFalse()
                ->end()
                ->booleanNode('autogrow')
                    ->defaultFalse()
                ->end()
            ->end();
    }

    /**
     * Gets the file node definition.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The config node definition.
     *
     * @return \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition The node definition.
     */
    protected function getFileNodeDefinition(ArrayNodeDefinition $node)
    {
        return $node
            ->children()
            ->arrayNode('file')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('name')
                        ->defaultValue('epiceditor')
                    ->end()
                    ->scalarNode('default_content')
                        ->defaultValue('')
                    ->end()
                    ->scalarNode('auto_save')
                        ->defaultValue('100')
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Gets the theme node definition.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The config node definition.
     *
     * @return \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition The node definition.
     */
    protected function getThemeNodeDefinition(ArrayNodeDefinition $node)
    {
        return $node
            ->children()
            ->arrayNode('theme')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('base')
                        ->defaultValue('/themes/base/epiceditor.css')
                    ->end()
                    ->scalarNode('preview')
                        ->defaultValue('/themes/preview/preview-dark.css')
                    ->end()
                    ->scalarNode('editor')
                        ->defaultValue('/themes/editor/epic-dark.css')
                    ->end()
                ->end()
            ->end();
    }

  /**
   * Gets the button node definition.
   *
   * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The config node definition.
   *
   * @return \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition The node definition.
   */
  protected function getButtonNodeDefinition(ArrayNodeDefinition $node)
  {
    return $node
        ->children()
        ->arrayNode('button')
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('preview')
                    ->defaultTrue()
                ->end()
                ->scalarNode('fullscreen')
                    ->defaultTrue()
                ->end()
                ->scalarNode('bar')
                    ->defaultValue('auto')
                ->end()
            ->end()
        ->end();
  }

    /**
     * Gets the shortcut node definition.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The config node definition.
     *
     * @return \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition The node definition.
     */
    protected function getShortcutNodeDefinition(ArrayNodeDefinition $node)
    {
        return $node
            ->children()
                ->arrayNode('shortcut')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('modifier')
                            ->defaultValue(18)
                        ->end()
                        ->scalarNode('fullscreen')
                            ->defaultValue(70)
                        ->end()
                        ->scalarNode('preview')
                            ->defaultValue(80)
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     * Gets the string node definition.
     *
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node The config node definition.
     *
     * @return \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition The node definition.
     */
    protected function getStringNodeDefinition(ArrayNodeDefinition $node)
    {
        return $node
            ->children()
            ->arrayNode('string')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('toggle_preview')
                        ->defaultValue('Toggle Preview Mode')
                    ->end()
                    ->scalarNode('toggle_edit')
                        ->defaultValue('Toggle Edit Mode')
                    ->end()
                    ->scalarNode('toggle_fullscreen')
                        ->defaultValue('Enter Fullscreen')
                    ->end()
                ->end()
            ->end();
    }
}
