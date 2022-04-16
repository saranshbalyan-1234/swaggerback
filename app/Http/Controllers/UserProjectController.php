<?php

namespace App\Http\Controllers;

use App\Models\UserProject;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\ModelRequest;
use Illuminate\Http\Request;

class UserProjectController extends Controller
{
    
    function addUserToProject(Request $req){
   $project= UserProject::create($req->all());
     return $project;
    }

    function getAllProjectByUser(){
      return UserProject::where(['user_id' =>Auth::user()->id])->with('info')->get();     
    }

    function update(Request $req){
        $temp = UserProjectController::find($req->id);
        $temp->update($req->all());
        return $temp;
    }

    function getUserProjectControllerById(Request $req){
      return UserProjectController::find($req->id);     
    }

    function deleteUserProjectControllerById(Request $req){
        $temp = UserProjectController::find($req->id);
        $temp->delete();
    }

}
