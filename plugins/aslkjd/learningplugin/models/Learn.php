<?php namespace Aslkjd\Learningplugin\Models;

use Model;

/**
 * Model
 */
class Learn extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'aslkjd_learningplugin_learning';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
