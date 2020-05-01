<?php namespace Academy\Course\Components;

use Academy\Course\Models\Step;
use Cms\Classes\ComponentBase;
use http\Env\Request;
use Illuminate\Support\Facades\Input;


class Excel extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'excel Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onSubmit() {
        $file = Input::file('file');
        $fileContent = file_get_contents($file->getRealPath());
        $json = explode("\r\n", $fileContent);
        foreach ($json as $key => $value){
            $json[$key] = explode(',',$value);
        }

        $keys = $json[0];
        unset($json[0]);
        $x = [];
        foreach ($json as $value){
            if (count($keys) == count($value)){
                self::_inserData(array_combine($keys, $value));
            }
        }


    }
    static function _inserData($fileContent){
        $req = new Step();
        $req->course_id = $fileContent['course_id'];
        $req->step_name = $fileContent['step_name'];
        $req->why = $fileContent['why'];
        $req->video_link = $fileContent['video_link'];
        $req->docs_link = $fileContent['docs_link'];
        $req->custom_text = $fileContent['custom_text'];
        $req->step_position = $fileContent['step_position'];
        $req->homework = $fileContent['homework'];

        $req->save();

    }

}
