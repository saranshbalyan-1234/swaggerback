<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\InfoRequest;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    
    function store(Request $req){
     return InfoController::create($req->all());
    }

    function getAllInfoController(){
      return InfoController::all();     
    }

    function update(Request $req){
        $temp = InfoController::find($req->id);
        $temp->update($req->all());
        return $temp;
    }

    function getInfoControllerById(Request $req){
      return InfoController::find($req->id);     
    }

    function deleteInfoControllerById(Request $req){
        $temp = InfoController::find($req->id);
        $temp->delete();
    }

}
