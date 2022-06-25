
<?php

use App\Models\Department;

if(!function_exists('departmentName')){
    function departmentName($id){
        $department = Department::find($id);
        return $department->name ?? '__';
    }
}

if(!function_exists('upload_image')){
    function upload_image($image, $route){
        $date = date('d-m-Y', time());
        $imageName = time() . rand(10, 10000) .'.' . $image->extension();
        $path = public_path(). '/public/img/uploads'. $route;
        // $image->move($path, $imageName);
        $image->storeAs('/', $imageName, 'uploads');
        $image_path = 'img/uploads/'.$imageName;
        return $image_path;
    }
}
