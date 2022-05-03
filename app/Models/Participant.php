<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Participant extends Pivot
{
    use HasFactory;

    protected $table = 'term_user';
    protected $guarded = [];


    public function scopeLearners(Builder $builder)
    {
        $user_id = auth()->user()->id;
        if (!auth()->user()->hasRole(['Super-Admin'])) {
            return $builder
            ->where(
                function ($q) use ($user_id) {
                    $q->where('role_id', 4);
                    $q->whereIn('term_id',  $this->select('term_id')->where('user_id', $user_id));
                   
                }
            );
        }
    }

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function Term()
    {
        return $this->hasOne(Term::class, 'id', 'term_id');
    }
}
