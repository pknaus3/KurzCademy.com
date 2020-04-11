<?php namespace AcademyMod\Course;

use AcademyMod\Course\Models\Course as Course;
use Backend;
use RainLab\User\Facades\Auth;
use System\Classes\PluginBase;

/**
 * course Plugin Information File
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
            'name'        => 'Course',
            'description' => 'Plugin slúži na tvorbu a editáciu kurzov',
            'author'      => 'KurzCademy.com',
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

        return [
            'AcademyMod\Course\Components\HomeWork' => 'HomeWork',
            'Academymod\Course\Components\Course' => 'Course',
            'Academymod\Course\Components\Steps' => 'Steps'
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
            'academymod.course.some_permission' => [
                'tab' => 'course',
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
            'course' => [
                'label'       => 'Vytvoriť kurz',
                'url'         => Backend::url('academymod/course/Course'),
                'icon'        => 'icon-leaf',
                'permissions' => ['academymod.course.*'],
                'order'       => 500,
            ],
            'Steps' => [
                'label'       => 'Editovať kurz',
                'url'         => Backend::url('academymod/course/Steps'),
                'icon'        => 'icon-leaf',
                'permissions' => ['academymod.course.*'],
                'order'       => 500,
            ],
        ];
    }

}
