<?php namespace Academymod\course\Models;

use Model;
use BackendAuth;
use RainLab\User\Facades\Auth;

/**
 * Steps Model
 */
class Steps extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'academymod_steps';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    public function getDropdownOptions()
    {

        $user = Auth::getUser()->id; #Get user login
        $courses = Course::where('publisher',$user) # select course where publisher is equal user login
                               ->orwhere('teacher_name',$user); # or teacher_name is equal user login
        $course = $courses->pluck('name','id'); # write all course [ 'id' => 'name' ]

        if ($courses->count() >= 1) { # write only if is more than one course
            return $course;
        }
        else # else write 'No results found'
        {
            return ['' => "---none---"];
        }
    }



    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [Course::class];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
