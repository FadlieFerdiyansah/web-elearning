<?php

namespace App\Traits;


Trait Search
{
    public function search($model, $view, $dataResult, $keyNameField)
    {
        $query =  request('q');

        return view($view, [
            $dataResult => $model::where($keyNameField, 'LIKE', "%$query%")->paginate(10)
        ]);
    }
}