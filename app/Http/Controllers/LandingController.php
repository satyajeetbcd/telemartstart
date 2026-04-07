<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LandingController extends Controller
{
    public function index()
    {
        $doctors = [
            ['name' => 'Dr. Rajesh Kumar', 'specialization' => 'General Medicine', 'opd_days' => 'Mon - Fri', 'timing_from' => '09:00 AM', 'timing_to' => '01:00 PM'],
            ['name' => 'Dr. Priya Sharma', 'specialization' => 'Pediatrics', 'opd_days' => 'Mon - Sat', 'timing_from' => '10:00 AM', 'timing_to' => '02:00 PM'],
            ['name' => 'Dr. Amit Verma', 'specialization' => 'Cardiology', 'opd_days' => 'Mon, Wed, Fri', 'timing_from' => '11:00 AM', 'timing_to' => '03:00 PM'],
            ['name' => 'Dr. Sunita Patel', 'specialization' => 'Dermatology', 'opd_days' => 'Tue - Sat', 'timing_from' => '09:30 AM', 'timing_to' => '01:30 PM'],
            ['name' => 'Dr. Vikram Singh', 'specialization' => 'Orthopedics', 'opd_days' => 'Mon - Fri', 'timing_from' => '10:00 AM', 'timing_to' => '04:00 PM'],
            ['name' => 'Dr. Neha Gupta', 'specialization' => 'Gynecology', 'opd_days' => 'Mon - Sat', 'timing_from' => '09:00 AM', 'timing_to' => '12:00 PM'],
        ];

        return view('pages.landing', compact('doctors'));
    }
}
