<?php namespace AcademyMod\CreateCourse\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Create Course Back-end Controller
 */
class CreateCourse extends Controller
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

        BackendMenu::setContext('AcademyMod.CreateCourse', 'createcourse', 'createcourse');
    }
}
