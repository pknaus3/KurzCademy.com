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
                'label'       => 'Kurz',
                'url'         => Backend::url('academy/course/course'),
                'icon'        => 'icon-leaf',
                'permissions' => ['academy.course.*'],
                'order'       => 500,
                'sideMenu'     => [
                    'course' => [
                        'label'       => 'Kurz',
                        'url'         => Backend::url('academy/course/course'),
                        'icon'        => 'icon-leaf',
                        'permissions' => ['academy.course.*'],
                        'order'       => 500,
                        ],
                    'step' => [
                        'label'       => 'Krok',
                        'url'         => Backend::url('academy/course/step'),
                        'icon'        => 'icon-leaf',
                        'permissions' => ['academy.course.*'],
                        'order'       => 500,
                    ],
                    'checkbox' => [
                        'label'       => 'Zaškrtnuté kroky',
                        'url'         => Backend::url('academy/course/checkbox'),
                        'icon'        => 'icon-leaf',
                        'permissions' => ['academy.course.*'],
                        'order'       => 500,
                    ],
                    'comments' => [
                        'label'       => 'Komentáre',
                        'url'         => Backend::url('academy/course/comments'),
                        'icon'        => 'icon-leaf',
                        'permissions' => ['academy.course.*'],
                        'order'       => 500,
                    ],
                    'favorites' => [
                        'label'       => 'Obľubené kurzy',
                        'url'         => Backend::url('academy/course/FavoriteCourses'),
                        'icon'        => 'icon-leaf',
                        'permissions' => ['academy.course.*'],
                        'order'       => 500,
                    ],
                ]
            ],


        ];
    }
}
