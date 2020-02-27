<?php namespace KurzCademy\CreateCourse\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Create Back-end Controller
 */
class Create extends Controller
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

        BackendMenu::setContext('KurzCademy.CreateCourse', 'createcourse', 'create');
    }
}
