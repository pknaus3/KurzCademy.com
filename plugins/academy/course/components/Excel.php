<?php namespace Academy\Course\Components;

use Academy\Course\Models\Step;
use Cms\Classes\ComponentBase;
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
        $file = $file->toArray();
        dd(file_get_contents($file['realPath']));
    }
    public function inserData($data){
        $file = $data;
        $file = json_decode($file);

        Step::create([
            'course_id' => $file['course_id'],
            'step_name' => $file['step_name'],
            'why' => $file['why'],
            'video_link' => $file['video_link'],
            'docs_link' => $file['docs_link'],
            'custom_text' => $file['custom_text'],
            'step_position' => $file['step_position'],
            'homework' => $file['homework'],
        ]);
    }

}
