<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    
     public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected function casts(): array
    {
    return [
        'start_date' => 'date',
        'end_date'   => 'date',
           ];
    }

    protected $fillable = [
    'user_id',
    'start_date',
    'end_date',
    'days',
    'reason',
    'status',
];

}
