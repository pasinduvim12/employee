<?php

namespace App\Http\Controllers\firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ImageController extends Controller
{
    public function store(Request $request)
    {
    $image = $request->file('image'); //image file from frontend  
    $images   = app('firebase.firestore')->database()->collection('images')->document('defT5uT7SDu9K5RFtIdl');  
    $firebase_storage_path = 'images/';  
    $name     = $images->id();  
   
    $extension = $image->getClientOriginalExtension();  
    $file      = $name. '.' . $extension;  
    if ($image->move($images, $file)) {  
        $uploadedfile = fopen($images.$file, 'r');  
        app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $name]);  
        //will remove from local laravel folder  
        unlink($images . $file);  
        echo 'success';  
    } else {  
        echo 'error';  
    }  

    }}