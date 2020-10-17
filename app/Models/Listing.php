<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    public function cards()
    {
        return $this->hasMany('App\Models\Card');
    }

    public function board()
    {
        return $this->hasMany('App\Models\Board','id', 'board_id');
    }
}
