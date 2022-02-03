<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment_deatail extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id',
        'name',
        'email',
        'phone',
        'date',
        'time',
        'created_by'
    ];
       public function getBussinessName(){
        $business = Business::find($this->business_id);
        if(!empty($business)){
            return $business->title;
        }else{
            return ' - ';
        }
    }
}
