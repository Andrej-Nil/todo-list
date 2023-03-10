<?php

namespace App\Models;

use App\Helpers\StatusHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $dates = ['date_of_delivery'];

    protected $fillable = [
        'title',
        'description',
        'status',
        'owner_id',
        'executor_id',
        'is_publish',
        'is_important',
        'is_urgent',
        'is_publish',
        'date_of_delivery',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'executor_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(){
       return StatusHelper::getName($this->status);
    }

    public function getCreatedDateAttribute() {
        $date = $this->created_at;
        if($date){
            return $date->format('d-m-Y');
        }
        return 'Не указано';
    }

    public function getDeliveryDateAttribute() {
        $date = $this->date_of_delivery;
        if($date){
            return $date->format('d-m-Y');
        }
        return 'Не указано';
    }

//    public function getOwnerNameAttribute(){
//        return $this->owner->name;
//    }




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

        if ($area == 'work') {
            $query->where('executor_id', $userId);
        } elseif ($area == 'create') {
            $query->where('owner_id', $userId);
        } else {

            $query->where(function ($query) use ($userId) {
                $query->where('owner_id', $userId)
                    ->orWhere(function ($query) use ($userId) {
                        $query->where([
                            ['is_publish', 0],
                            ['owner_id', $userId]
                        ])->orWhere('is_publish', 1);
                    });
            });

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

    }


    public function scopeSort($query, $request)
    {
        $sortType = 'created_at';
        $sortValue = 'DESC';
        if (!empty($request['sorting'])) {

            $sort = $request['sorting'];

            if ($sort == 'important') {
                $sortType = 'is_important';
            } else if ($sort == 'urgent') {
                $sortType = 'is_urgent';
            } else if ($sort == 'abc') {
                $sortType = 'title';
                $sortValue = 'ASC';
            }

        }
        $query->orderBy($sortType, $sortValue);
    }


}
