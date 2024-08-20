<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    use HasFactory;
    public $appends = ['status'];
    protected $fillable = [
        'title',
        'description',
        'description_text',
        'due_date',
        'assginee_id',
        'category_id',
        'priority',
        'tag',
        'status_id'
    ];

    public function status() {
        return $this->belongsTo(Status::class,'status_id','id');
    }

    public function getDueDateAttribute($value){
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function getStatusAttribute() {
        return $this->status_id;

    }
}
