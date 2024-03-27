<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStages extends Model
{
    use HasFactory;
    protected $table = 'project_stages';
    protected $fillable = [
     'name',
    ];

}
