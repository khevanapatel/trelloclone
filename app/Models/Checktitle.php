<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checktitle extends Model
{
    use HasFactory;
    protected $table = 'checklist_title';

    public function checklist()
    {
        return $this->hasMany('App\Models\Checklist','title_id','id');
    }

}
