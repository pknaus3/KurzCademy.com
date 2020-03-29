<?php namespace AcademyMod\CreateCourse\Models;

use Model;
use RainLab\User\Models\User;

/**
 * createCourse Model
 */
class CreateCourse extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'academymod_createcourse_create_courses';

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
    public function getPublisherOnly($field){
        $user = User::getUser()->login;
        $courses = CreateCourse::where('publisher',$user)
                               ->orwhere('teacher_name',$user);
        $course = $courses->pluck($field);

        return [$course];
    }

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [Editor::class];
    public $belongsTo = [];
    public $belongsToMany = [User::class];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'CourseThumb' => 'System\Models\File'
    ];
    public $attachMany = [];
}
