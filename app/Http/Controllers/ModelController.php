<?php

namespace App\Http\Controllers;

use App\Models\Models;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\ModelRequest;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    
  function addModel(Request $req){
    
    $model = new Models;
    $model->name=$req->name;
    $model->project_id=$req->project_id;
    $model->type='object';
    $model->properties=$req->properties;
   //  if(isset($value['xml'])) $model->xml=$value['xml'];
    $model->save();
   return $model;
}
function getAllModels(){
 return Models::all();
}
function delete(Request $req){
 Models::find($req->id)->delete();
   return response()->json(["status"=>"deleted"]);
 }

}
