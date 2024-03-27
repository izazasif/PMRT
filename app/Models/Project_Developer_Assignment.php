<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_Developer_Assignment extends Model
{
    use HasFactory;
    protected $table = 'project__developer__assignments';
    protected $fillable = [
     'project_id','developer_id','role_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User','developer_id');
    }
    public function projects()
    {
        return $this->belongsTo('App\Models\Projects','project_id');
    }
    public function roles()
    {
        return $this->belongsTo('App\Models\Roles','role_id');
    }
}
