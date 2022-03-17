<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Tag;
use App\Models\Path;
use App\Models\Models;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\ModelRequest;
use Illuminate\Http\Request;

class SwaggerController extends Controller
{
    
    function get(Request $req){
      $info=Info::all();

      $tags = Tag::where(['project_id' => $req->project_id])->get();
      $paths=Path::where(['project_id' => $req->project_id])->get();
      $models=Models::where(['project_id' => $req->project_id])->get();
      $temp = $tags->toArray();
      $temp1=[];
      foreach ($temp as $el){ 
      $el['externalDocs']=[];
      if($el['external_desc']!=null){ $el['externalDocs']['description']=$el['external_desc']; }
      if($el['external_url']!=null){ $el['externalDocs']['url']=$el['external_url']; }
      array_push($temp1, $el);
        }

     return response()->json([
     "paths" => "2.0",
     "swagger" => "2.0",
     "info"=>$info[0],
     "basePath"=>$info[0]['basePath'],
     "host"=>$info[0]['host'],
     "tags"=>$temp1,
     "path"=>$paths,
     "models"=>$models,
    ]);
    }



}
