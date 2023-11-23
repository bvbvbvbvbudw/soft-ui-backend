<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'task';

    protected $fillable = [
        'name',
        'user_id',
        'status_id',
        'project_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

// In the User model
    public function avatar()
    {
        return $this->hasOne(Avatar::class);
    }



    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }
    public function informationTask()
    {
        return $this->hasMany(InformationTask::class);
    }
    public function description(){
        return $this->hasMany(TaskDescription::class);
    }
    public function photo()
    {
        return $this->hasMany(PhotoTask::class);
    }
    public function assigneds(){
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');
    }

//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }
    public function rolesfind()
    {
        return $this -> belongsTo(Role::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function status(){
        return $this -> belongsTo(Status::class);
    }
}
