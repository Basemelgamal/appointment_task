<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['appointment', 'reason', 'user_id'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the Create At Row.
     *
     * @param  string  $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('dM y');
    }
}
