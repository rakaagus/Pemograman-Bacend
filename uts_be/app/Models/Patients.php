<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    //

    protected $fillable = ['nama', 'status', 'in_date_at', 'out_date_at', 'patients_infos_id'];

    public function patientsInfo(){
        return $this->belongsTo(PatientsInfo::class, 'patients_infos_id');
    }
}
