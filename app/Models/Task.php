<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'is_publish',
        'is_important',
        'is_urgent',
        'is_publish',
        'date_of_delivery',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
