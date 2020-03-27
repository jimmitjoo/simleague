<?php

namespace App;

use App\Traits\HasSalary;
use Illuminate\Database\Eloquent\Model;

class ManagerContract extends Model
{
    use HasSalary;

    protected $fillable = [
        'from',
        'wage',
        'until',
        'club_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
