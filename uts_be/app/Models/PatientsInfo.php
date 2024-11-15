<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientsInfo extends Model
{
    //
    protected $fillable = ['phone', 'address'];

    public function patientsInfo(){
        return $this->hasOne(Patients::class, 'patients_infos_id');
    }
}
