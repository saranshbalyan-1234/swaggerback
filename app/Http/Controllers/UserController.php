<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function register(UserRequest $req){
        $temp = collect($req->all());
        $temp->put('password', Hash::make($req->password));
        $user = User::create($temp->toArray());
        return $user;
    }

    function update(Request $req){
        $user = User::find(Auth::user()->id);
        $temp = collect($req->all());
        $temp->forget('password');
        if($req->oldPassword && $req->newPassword){
            if(Hash::check($req->oldPassword, $user->password)  ){
                $temp->put('password', Hash::make($req->newPassword));
            }
            else{
                return response()->json(['error' => "Old password is not correct."]);
            }
        }
     
       $user->update($temp->toArray());
        return $user;
    }

    function getUserById(){
        $user= User::find(Auth::user()->id);
        return $user;
    }
    function getAllUser(Request $req){
        $projectUser= Project::select('user_id')->where(['id' => $req->project_id])-get();
        $allUser=User::all();     
      return response()->json(['projectUser' =>$projectUser,"allUser"=>$allUser]);
    }
       function login(Request $req){   
        
        $check=false;
        $user = User::where(['email' => $req->email])
            ->first();

            if($user){
            $check=Hash::check($req->password, $user->password);  
            }

            if($check){
                $token=  $user->createToken($user->name)->plainTextToken; 
                $user->token=$token;
            return $user;
            } else {
            return response()->json(['errors' =>[ 'Invalid Email or Password'],"status"=>"exception"],403);
            }
        
    }
    function logout(Request $req){
        $req->user()->currentAccessToken()->delete();
        return response()->json(['logoutData' => "Successfully Logged Out","status"=>"success"]);
    }
    function deleteUserById(){
        $temp = User::find(Auth::user()->id);
        $temp->delete();
    }

}
