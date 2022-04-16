<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    use HasFactory;
        protected $table="user_projects";

    protected $fillable = ['user_id','project_id'];

    public function info()
    {
        return $this->hasOne(Info::class, 'project_id','project_id');
    }
     public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
    
}
