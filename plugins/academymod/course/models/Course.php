<?php namespace AcademyMod\Course\Models;

use Academymod\course\Components\HomeWork;
use Model;
use RainLab\User\Models\User;

/**
 * course Model
 */
class Course extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'academymod_courses';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'name','publisher','difficulty','description','teacher_name','CourseThumb'
    ];

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
    /* This function show only courses which belongTo his owner */

    public function getTeacherName(){
        $users = User::all()->pluck('name', 'id');
        return $users;
    }


    #public function getUserName($value, $column, $record){
     #   $user = User::where('id', $record->teacher_name)->first();
      #  return $user->get();
    #}

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [Steps::class];
    public $belongsTo = [];
    public $belongsToMany = [User::class];
    public $morphTo = [
        'attachment' => []
    ];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'CourseThumb' => 'System\Models\File'
    ];
    public $attachMany = [
        'homeWorks' => 'System\Models\File'
    ];
}
