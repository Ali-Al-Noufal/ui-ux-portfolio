<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Workbench\App\Models\User;

class Skill extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
