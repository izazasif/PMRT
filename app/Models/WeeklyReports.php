<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyReports extends Model
{
    use HasFactory;
    protected $table = 'weekly_reports';
    protected $fillable = [
     'project_id','developer_id','timeline','task_completed'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User','developer_id');
    }
    public function projects()
    {
        return $this->belongsTo('App\Models\Projects','project_id');
    }
}
