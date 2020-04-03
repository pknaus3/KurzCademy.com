<?php namespace Academymod\Createcourse\Components;

use Backend\Controllers\Auth;
use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Input;

class HomeWork extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'HomeWork Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
    public function onSubmit(){

        $file = new System\Models\File;
        $file->data = Input::file('file');
        $file->save();

        // Attach the uploaded file to your model
        $model->HomeWork()->add($file);
        // The above line assumes you have proper attachOne or attachMany relationships defined on your model - in this case, I have named the relationship simply as "file"

        $model->file_path = url('/') . $model->HomeWork->getPath();
        $model->save();

        return Redirect::back();

    }
}
