<?php namespace Academy\Course\Models;

use Backend\Facades\BackendAuth;
use Model;
use RainLab\User\Facades\Auth;
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
    public $table = 'academy_course_courses';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['*'];

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

    public function getNameOptions($scopes = null)
    {
        $userId - Auth::getUser();

            return Course::where($userId, 'id')->get();

    }

    public function getTeacherOptions()
    {
        $beUser = BackendAuth::getUser();
        $user = Auth::getUser();
        if ($beUser->hasAccess('academy.course.edit_courses')) {
            return User::all()->pluck('name', 'id');
        }else {
            return [$user->id, $user->name];
        }
    }

    public function getPublisherOptions()
    {
        $beUser = BackendAuth::getUser();
        $user = Auth::getUser();
        if ($beUser->hasAccess('academy.course.edit_courses')) {
            return User::all()->pluck('name', 'id');
        }else {
            return [$user->id, $user->name];
        }
    }

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'step' => Step::class,
    ];
    public $belongsTo = [
        'publisher' => User::class,
        'teacher' => User::class
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'courseThumb' => 'System\Models\File'
    ];
    public $attachMany = [
        'homeworks' => 'System\Models\File'
    ];
}
