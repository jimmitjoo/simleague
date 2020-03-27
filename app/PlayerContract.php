<?php

namespace App;

use App\Traits\HasSalary;
use Illuminate\Database\Eloquent\Model;

class PlayerContract extends Model
{
    use HasSalary;

    protected $fillable = [
        'from',
        'wage',
        'type',
        'until',
        'club_id',
        'person_id',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
