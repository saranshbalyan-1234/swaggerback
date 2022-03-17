<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Tag;
use App\Models\Path;
use App\Models\Project;
use App\Models\Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ModelRequest;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    
    function import(Request $req){
    $this->importModels($req);
    $this->importInfo($req);
    $this->importTags($req);
    $this->importPaths($req);
     return "imported";
    }

    function createProject(Request $req){
      $project= new Project;
      $project->name="newProject";
      $project->user_id=Auth::user()->id;
      $project->save();
      return $project;
    }


    function importInfo(Request $req){
      $info = new Info;
      $info->project_id=$req->project_id;
      if(isset($req->info['description'])) $info->description=$req->info['description'];
      if(isset($req->info['version'])) $info->version=$req->info['version'];
      if(isset($req->info['title'])) $info->title=$req->info['title'];
      if(isset($req->info['termsOfService'])) $info->termsOfService=$req->info['termsOfService'];
      if(isset($req->info['license'])) $info->license=$req->info['license'];
      if(isset($req->info['contact'])) $info->contact=json_encode($req->info['contact']);
      if(isset($req->info['license'])) $info->license=json_encode($req->info['license']);
      if(isset($req->schemes)) $info->schemes=json_encode($req->schemes);
      if(isset($req->host)) $info->host=$req->host;
      if(isset($req->basePath)) $info->basePath=$req->basePath;
      $info->save();
    }

    function importTags( $req){

      foreach ($req->tags as $el){ 
      $tag=new Tag;
      $tag->project_id=$req->project_id;
      if(isset($el['name'])) $tag->name=$el['name'];
      if(isset($el['description'])) $tag->description=$el['description'];

      if(isset($el['externalDocs'])){
        $el['externalDocs']['description'] && $tag->external_desc=$el['externalDocs']['description'];
        $el['externalDocs']['url'] && $tag->external_url=$el['externalDocs']['url'];
     }
      $tag->save();
        }
    }

    function importPaths(Request $req){
      foreach( $req->paths as $key => $value )
      {
        foreach( $value as $key1 => $value1 )
        {
         $path = new Path;
         $path->project_id=$req->project_id;
         $path->path=$key;
         $path->type=$key1;
         if(isset($value1['consumes']))  $path->consumes=json_encode($value1['consumes']);
         if(isset($value1['parameters']))  $path->parameters=json_encode($value1['parameters']);
         if(isset($value1['produces']))  $path->produces=json_encode($value1['produces']);
         if(isset($value1['tags'])) $path->tags=json_encode($value1['tags']);
         if(isset($value1['responses'])) $path->responses=json_encode($value1['responses']);
         if(isset($value1['requestBody'])) $path->responses=json_encode($value1['requestBody']);
         if(isset($value1['security'] )) $path->security=json_encode($value1['security']);
         if(isset($value1['description']))  $path->description=$value1['description'];
         if(isset($value1['summary'])) $path->summary=$value1['summary'];
         if(isset($value1['operationId'])) $path->operationId=$value1['operationId'];
         $path->save();
        
        }
      }
    }
    function importModels(Request $req){
      foreach( $req->definitions as $key => $value )
      {       
         $model = new Models;
         $model->name=$key;
         $model->project_id=$req->project_id;
         if(isset($value['type'])) $model->type=$value['type'];
         if(isset($value['properties'])) $model->properties=json_encode($value['properties']);
         if(isset($value['xml'])) $model->xml=json_encode($value['xml']);
         $model->save();
      }
    }
    

}
