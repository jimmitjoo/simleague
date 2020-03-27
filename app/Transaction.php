<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'club_id',
        'sum',
        'relatable_id',
        'relatable_type',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function($transaction) {
            $club = Club::find($transaction->club_id);
            $club->balance -= $transaction->sum;
            $club->save();
        });
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function getIsPlayerContractAttribute()
    {
        return $this->relatable_type == 'App\PlayerContract';
    }

    public function getIsManagerContractAttribute()
    {
        return $this->relatable_type == 'App\ManagerContract';
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'relatable_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'relatable_id');
    }
}
