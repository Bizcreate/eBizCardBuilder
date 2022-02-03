<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appoinment extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id',
        'content',
        'is_enabled',
        'created_by'
    ];
}
