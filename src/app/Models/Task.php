<?php

namespace App\Models;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Scopes\UserScope;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'completedAt',
        'user_id'
    ];

    public function setPriorityAttribute($value)
    {
        if($value == null){
            $this->attributes['priority'] =  TaskPriority::LOW_PRIORITY->value;
        }else{
            $this->attributes['priority'] =  $value;
        }
    }


    public function setStatusAttribute($value)
    {
        if($value == null){
            $this->attributes['status'] = TaskStatus::TODO->value;
        }else{
            $this->attributes['status'] = $value;
        }
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope);
    }
}
