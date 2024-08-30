<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'description_text',
        'due_date',
        'assginee_id',
        'category_id',
        'priority',
        'tag',
        'status_id',
    ];

    public function status() {
        return $this->belongsTo(Status::class,'status_id','id');
    }
}
