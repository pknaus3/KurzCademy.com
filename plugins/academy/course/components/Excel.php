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
        //var_dump($fileContent);
        self::_inserData($fileContent);

        $json = '﻿{"courseId":1,"test":5}';

        dump(json_decode($json));

        $json1 = '{"Peter":65,"Harry":80,"John":78,"Clark":90}';

        //var_dump(json_decode($json1));

    }
    static function _inserData($fileContent){
        $step = json_decode($fileContent);

/*'{"courseId":1,"test":5}'
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
*/
    }

}
