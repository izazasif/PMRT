<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer_Skills extends Model
{
    use HasFactory;
    protected $table = 'developer__skills';
    protected $fillable = [
     'developer_id','technology_id','expertise_level'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User','developer_id');
    }
    public function technologies()
    {
        return $this->belongsTo('App\Models\Technologies','technology_id');
    }
}
