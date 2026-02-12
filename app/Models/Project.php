<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Workbench\App\Models\User;

class Project extends Model
{
        protected $fillable = [
        'title',
        'image',
        'description',
        'url',
        'type',
        'features'
    ];
        public function user(){
        return $this->belongsTo(User::class);
    }
            function getImageUrlAttribute(){
        if($this->image){
            return $this->image;
        }
        return null;
    }
        protected $appends=[
        "image_url",
    ];
}
