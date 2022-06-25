<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(){
        $input = [
            'appointments' => auth()->user()->appointments,
        ];
        return view('website.appointments.index', $input);
    }
}
