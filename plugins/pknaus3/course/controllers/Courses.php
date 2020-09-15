<?php namespace Pknaus3\Course\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Courses Back-end Controller
 */
class Courses extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController'
    ];

    public $relationConfig = 'config_relation.yaml';

    /**
     * @var string Configuration file for the `FormController` behavior.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string Configuration file for the `ListController` behavior.
     */
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Pknaus3.Course', 'course', 'courses');
    }
}
