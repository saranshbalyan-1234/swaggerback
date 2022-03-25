<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table="projects";
    protected $fillable = ['name'];
    public function info()
    {
        return $this->hasOne(Info::class, 'project_id','id');
    }
}