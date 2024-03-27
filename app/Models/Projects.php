<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
     'name','client_spoke_name','client_spoke_mobile','client_spoke_email','miaki_spoke_name',
     'miaki_spoke_mobile','miaki_spoke_email','customer_name','srs_pdf','ui_ux_link',
     'rep_link','timeline','remarks','project_stage_id',
    ];
    public function projectstages()
    {
        return $this->belongsTo('App\Models\ProjectStages','project_stage_id');
    }
}
