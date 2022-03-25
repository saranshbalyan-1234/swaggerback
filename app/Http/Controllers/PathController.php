<?php

namespace App\Http\Controllers;

use App\Models\Path;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\ModelRequest;
use Illuminate\Http\Request;

class PathController extends Controller
{
    
    function addPath(Request $req){
     return Path::create($req->all());
    }

    function getAllPathController(){
      return PathController::all();     
    }


    function update(Request $req){
        $temp = Path::find($req->id);
        $temp->update($req->all());
        return $temp;
    }

    function getPathControllerById(Request $req){
      return PathController::find($req->id);     
    }

    function deletePath(Request $req){
        $temp = Path::find($req->id);
        $temp->delete();
    }

}
