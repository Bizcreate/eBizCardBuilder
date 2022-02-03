<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'designation',
        'sub_title',
        'description',
        'banner',
        'logo',
        'card_theme',
        'theme_color',
        'created_by'

    ];

    public function getLanguage(){
        $user = User::find($this->created_by);
        return $user->currentLanguage();
    }
}
