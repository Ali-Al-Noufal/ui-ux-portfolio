<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Workbench\App\Models\User;

class Message extends Model
{
    protected $fillable = [
        'name',
        'title',
        'content',
    ];
        public function user(){
        return $this->belongsTo(User::class);
    }
}
