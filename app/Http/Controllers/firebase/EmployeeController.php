<?php

namespace App\Http\Controllers\firebase;

use Illuminate\Http\Request;
use Kreait\Firebase\Database;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Kreait\Firebase\Firestore;
use Google\Cloud\Firestore\FirestoreClient;


class EmployeeController extends Controller
{

    public function __construct(Database $database)
    {
        $this->database=$database;  
        $this->tablename='employee'; 
    }
    public function index()
    { 
        $employees= $this->database->getReference($this->tablename)->getValue();
        $total_emploees= $reference =$this->database->getReference($this->tablename)->getSnapshot()->numChildren();
        return view('firebase.employee.index',compact('employees', 'total_emploees'));
    }

    public function create()
    { 
        
        return view('firebase.employee.create');
    }
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

    

    $request->validate([
        'fname'=>'required|regex:/^[\pL\s\-]+$/u|min:5|max:25',
        'phone' => 'required|min:6|max:11',
        'Eid' => 'required|min:4|max:10',
        'Position' => 'required|min:2|max:40'
    ]);
   
    $postData = [
        'fname' => $request->fname,
        'phone' => $request->phone,
        'Eid' => $request->Eid,
        'Position' => $request->Position,
        // 'photo'=>$request->photo,


        
           
           
    ];

    
$postRef = $this->database->getReference($this->tablename)->push($postData);
if($postRef)
{
    return redirect('employees')->with('status','Employee added Successfully');
}
else
{
    return redirect('employees')->with('status','Employee added Not added ');
}

}

public function edit($id){

    $key =$id;
    $editdata= $this->database->getReference($this->tablename)->getChild($key)->getValue();
    if($editdata){
        
        return view('firebase.employee.edit',compact('editdata','key'));
   
    }
    else{
        return redirect('employees')->with('status','Employee ID Not found ');
    }
}

public function update(Request $request, $id)
{
    $key =$id;
    $updateData = [
        'fname' => $request->fname,
        'phone' => $request->phone,
        'Eid' => $request->Eid ,
        'Position' => $request->Position,
    ];
  $res_updated = $this->database->getReference($this->tablename.'/'.$key)->update($updateData);
  if($res_updated)
  {
    return redirect('employees')->with('status','Employee Details update successfully ');
  }
  else{
    return redirect('employees')->with('status','Employee Detailst Not update');
  }

}

public function destroy($id){

    $key=$id;
    $del_data = $this->database->getReference($this->tablename.'/'.$key)->remove();
    
    if($del_data){
        return redirect('employees')->with('status','Employee Details deleted successfully ');

    }
    else{
        return redirect('employees')->with('status','Employee Details Not deleted');

    }
 }

}


