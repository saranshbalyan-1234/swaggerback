<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Path extends Model
{
    use HasFactory;
    protected $table="paths";

    protected $fillable = [
        'path','type','summary','project_id','deprecated','security','description','operationId','consumes','produces','tags','responses','parameters'
     ];
}
