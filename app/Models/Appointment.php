<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['appointment', 'reason', 'user_id'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
