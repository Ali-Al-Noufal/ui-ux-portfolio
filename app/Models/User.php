<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Message;
use App\Models\Testemonial;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'yearsOfExperiance',
        'projectNumber',
        'about_me',
        'address',
        'image',
        'phone',
        'password',
        'cv',
    ];
    public function skills(){
        return $this->hasMany(Skill::class);
    }
        public function projects(){
        return $this->hasMany(Project::class);
    }
        public function messages(){
        return $this->hasMany(Message::class);
    }
        public function testemonials(){
        return $this->hasMany(Testemonial::class);
    }
    function getImageUrlAttribute(){
        if($this->image){
            return $this->image;
        }
        return null;
    }
        function getcvUrlAttribute(){
        if($this->cv){
            return $this->cv;
        }
        return null;
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $appends=[
        "image_url","cv_url"
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
