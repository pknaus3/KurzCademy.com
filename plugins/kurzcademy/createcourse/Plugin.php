<?php namespace KurzCademy\CreateCourse;

use Backend;
use System\Classes\PluginBase;

/**
 * createCourse Plugin Information File
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
            'name'        => 'createCourse',
            'description' => 'No description provided yet...',
            'author'      => 'kurzCademy',
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
            'KurzCademy\CreateCourse\Components\MyComponent' => 'myComponent',
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
            'kurzcademy.createcourse.some_permission' => [
                'tab' => 'createCourse',
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
            'createcourse' => [
                'label'       => 'Vytvoriť nový kurz',
                'url'         => Backend::url('kurzcademy/createcourse/Create'),
                'icon'        => 'icon-leaf',
                'permissions' => ['kurzcademy.createcourse.*'],
                'order'       => 500,
            ],
        ];
    }
}
