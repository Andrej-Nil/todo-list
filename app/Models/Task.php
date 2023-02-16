<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'status',
        'owner_id',
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

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, $request)
    {
        $userId = Auth::user()->id;
        $area = $request['area'];
        $important = $request['important'];
        $urgent = $request['urgent'];
        $waiting = $request['waiting'];
        $active = $request['active'];
        $pause = $request['pause'];
        $complete = $request['complete'];
//        orWhere('owner_id', $userId)->
//        where('is_publish', 1)->


//        if($area){
//            switch ($area){
//                case('stack'):{
//
//                }
//                case('work'):{
//
//                }
//                case('create'):{
//
//                }
//            }
//        }
        if ($area) {
            if ($area == 'stack') {
                $query->where('owner_id', $userId)
                    ->orWhere('is_publish', 1)
                    ->orWhere(function ($query) use ($userId) {
                        $query->where([
                                ['is_publish', 0],
                                ['owner_id', $userId]
                            ]);
                    });
            } elseif ($area == 'work') {
                $query->whereHas('users', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                });
            } elseif ($area == 'create') {
                $query->where('owner_id', $userId);
            }
        }

        if ($request['search']) {
            $query->where('title', 'LIKE', '%' . $request['search'] . '%');
        }

        if ($waiting ||
            $active ||
            $complete ||
            $pause ||
            $important ||
            $urgent

        ) {
            $query->where(function ($query) use (
                $waiting,
                $active,
                $complete,
                $pause,
                $important,
                $urgent
            ) {
                if ($waiting) {
                    $query->orWhere('status', 0);
                }
                if ($active) {
                    $query->orWhere('status', 1);
                }
                if ($pause) {
                    $query->orWhere('status', 2);
                }
                if ($complete) {
                    $query->orWhere('status', 3);
                }
                if ($important) {
                    $query->orWhere('is_important', 1);
                }
                if ($urgent) {
                    $query->orWhere('is_urgent', 1);
                }
            });
        }

//        if ($request['active']) {
//
//        }
//        if ($request['complete']) {
//            $query->where('status', 3);
//        }
    }


    public function scopeSort($query, $request)
    {
        $sortType = 'created_at';
        $sortValue = 'DESC';
        if (!empty($request['sort'])) {
            $sort = $request['sort'];
            if ($sort == 1) {
                $sortValue = 'ASC';
            } else if ($sort == 2) {
                $sortType = 'title';
                $sortValue = 'ASC';
            } else if ($sort == 3) {
                $sortType = 'title';
            }
        }
        $query->orderBy($sortType, $sortValue);
    }


}
