<?php namespace Academy\Course\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Course Back-end Controller
 */
class Course extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Academy.Course', 'course', 'course');
    }
}
