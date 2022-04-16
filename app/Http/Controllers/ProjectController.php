<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\UserProject;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\ModelRequest;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    
  function createProject(Request $req){
    $project= new Project;
    // $project->name=$req->projectName;
    // $project->user_id=Auth::user()->id;
    $project->save();
    $userProject=new UserProject();
    $userProject->user_id=Auth::user()->id;
    $userProject->project_id=$project->id;
    $userProject->admin=$req->admin;
    $userProject->save();
    return $project;
  }

    

    function update(Request $req){
        $temp = Project::find($req->id);
        $temp->update($req->all());
        return $temp;
    }

    function getProjectById(Request $req){
      return Project::find($req->id);     
    }

    function deleteProjectById(Request $req){
        $temp = Project::find($req->id);
        $temp->delete();
        return "Deleted";
    }

}
