<?php namespace AcademyMod\CreateCourse;

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
            'author'      => 'academyMod',
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
            'AcademyMod\CreateCourse\Components\MyComponent' => 'myComponent',
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
            'academymod.createcourse.some_permission' => [
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
                'label'       => 'Vytvoriť kurz',
                'url'         => Backend::url('academymod/createcourse/CreateCourse'),
                'icon'        => 'icon-leaf',
                'permissions' => ['academymod.createcourse.*'],
                'order'       => 500,
            ],
            'Editor' => [
                'label'       => 'Editovať kurz',
                'url'         => Backend::url('academymod/createcourse/Editor'),
                'icon'        => 'icon-leaf',
                'permissions' => ['academymod.createcourse.*'],
                'order'       => 500,
            ],
        ];
    }
}
