<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Path;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
// use App\Http\Requests\ModelRequest;
use Illuminate\Http\Request;

class TagController extends Controller
{
    
    function addTag(Request $req){
     return Tag::create($req->all());
    }

    function getAllTagController(){
      return TagController::all();     
    }

    function update(Request $req){
        $temp = TagController::find($req->id);
        $temp->update($req->all());
        return $temp;
    }

    function getTagControllerById(Request $req){
      return TagController::find($req->id);     
    }

    function deleteTag(Request $req){
        $tag = Tag::find($req->id);
        $paths=Path::where(['tags' => '["'.$tag['name'].'"]'])->get();
        foreach ($paths as $el){
          Path::find($el['id'])->delete();
          }
        $tag->delete();
        return "success";

    }

}
