<?php namespace Pknaus3\Topic;

use Backend;
use System\Classes\PluginBase;

/**
 * topic Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'topic',
            'description' => 'No description provided yet...',
            'author'      => 'pknaus3',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Pknaus3\Topic\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'pknaus3.topic.some_permission' => [
                'tab' => 'topic',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'topic' => [
                'label'       => 'topic',
                'url'         => Backend::url('pknaus3/topic/topics'),
                'icon'        => 'icon-leaf',
                'permissions' => ['pknaus3.topic.*'],
                'order'       => 500,
            ],
            'video' => [
                'label'       => 'Video',
                'url'         => Backend::url('pknaus3/topic/videos'),
                'icon'        => 'icon-leaf',
                'permissions' => ['pknaus3.topic.*'],
                'order'       => 500,
            ],
        ];
    }
}
