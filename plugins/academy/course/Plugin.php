<?php namespace Academy\Course;

use Backend;
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
            'name'        => 'course',
            'description' => 'No description provided yet...',
            'author'      => 'academy',
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
            'Academy\Course\Components\Homework' => 'homework',
            'Academy\Course\Components\Excel' => 'excel',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'academy.course.edit_courses' => [
                'tab' => 'academy.course',
                'label' => 'Acces edit all courses'
            ],
            'academy.course.viewCourses' => [
                'tab' => 'Course',
                'label' => 'Acces edit all courses'
            ]
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
                'label'       => 'Courses',
                'url'         => Backend::url('academy/course/course'),
                'icon'        => 'icon-leaf',
                'permissions' => ['academy.course.*'],
                'order'       => 500,
            ],
        ];
    }
}
