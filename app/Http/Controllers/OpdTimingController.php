<?php

namespace App\Http\Controllers;

class OpdTimingController extends Controller
{
    public function index()
    {
        $doctors = [
            ['id' => 1, 'name' => 'Dr. Rajesh Kumar', 'specialization' => 'General Medicine', 'state' => 'Delhi', 'opd_days' => 'Mon - Fri', 'timing_from' => '09:00 AM', 'timing_to' => '01:00 PM'],
            ['id' => 2, 'name' => 'Dr. Priya Sharma', 'specialization' => 'Pediatrics', 'state' => 'Delhi', 'opd_days' => 'Mon - Sat', 'timing_from' => '10:00 AM', 'timing_to' => '02:00 PM'],
            ['id' => 3, 'name' => 'Dr. Amit Verma', 'specialization' => 'Cardiology', 'state' => 'Maharashtra', 'opd_days' => 'Mon, Wed, Fri', 'timing_from' => '11:00 AM', 'timing_to' => '03:00 PM'],
            ['id' => 4, 'name' => 'Dr. Sunita Patel', 'specialization' => 'Dermatology', 'state' => 'Gujarat', 'opd_days' => 'Tue - Sat', 'timing_from' => '09:30 AM', 'timing_to' => '01:30 PM'],
            ['id' => 5, 'name' => 'Dr. Vikram Singh', 'specialization' => 'Orthopedics', 'state' => 'Rajasthan', 'opd_days' => 'Mon - Fri', 'timing_from' => '10:00 AM', 'timing_to' => '04:00 PM'],
            ['id' => 6, 'name' => 'Dr. Neha Gupta', 'specialization' => 'Gynecology', 'state' => 'Uttar Pradesh', 'opd_days' => 'Mon - Sat', 'timing_from' => '09:00 AM', 'timing_to' => '12:00 PM'],
            ['id' => 7, 'name' => 'Dr. Arjun Reddy', 'specialization' => 'ENT', 'state' => 'Telangana', 'opd_days' => 'Mon, Wed, Fri', 'timing_from' => '02:00 PM', 'timing_to' => '06:00 PM'],
            ['id' => 8, 'name' => 'Dr. Kavita Nair', 'specialization' => 'Ophthalmology', 'state' => 'Kerala', 'opd_days' => 'Mon - Fri', 'timing_from' => '08:00 AM', 'timing_to' => '12:00 PM'],
            ['id' => 9, 'name' => 'Dr. Suresh Iyer', 'specialization' => 'General Medicine', 'state' => 'Tamil Nadu', 'opd_days' => 'Mon - Sat', 'timing_from' => '10:00 AM', 'timing_to' => '02:00 PM'],
            ['id' => 10, 'name' => 'Dr. Meena Joshi', 'specialization' => 'Pediatrics', 'state' => 'Maharashtra', 'opd_days' => 'Tue, Thu, Sat', 'timing_from' => '09:00 AM', 'timing_to' => '01:00 PM'],
            ['id' => 11, 'name' => 'Dr. Ramesh Agarwal', 'specialization' => 'Cardiology', 'state' => 'Uttar Pradesh', 'opd_days' => 'Mon - Fri', 'timing_from' => '11:00 AM', 'timing_to' => '05:00 PM'],
            ['id' => 12, 'name' => 'Dr. Anjali Mehta', 'specialization' => 'Dermatology', 'state' => 'Karnataka', 'opd_days' => 'Mon - Sat', 'timing_from' => '09:00 AM', 'timing_to' => '01:00 PM'],
            ['id' => 13, 'name' => 'Dr. Sanjay Mishra', 'specialization' => 'Orthopedics', 'state' => 'Madhya Pradesh', 'opd_days' => 'Mon, Wed, Fri', 'timing_from' => '10:00 AM', 'timing_to' => '02:00 PM'],
            ['id' => 14, 'name' => 'Dr. Pooja Rao', 'specialization' => 'Gynecology', 'state' => 'Karnataka', 'opd_days' => 'Mon - Fri', 'timing_from' => '09:30 AM', 'timing_to' => '03:30 PM'],
            ['id' => 15, 'name' => 'Dr. Manoj Tiwari', 'specialization' => 'ENT', 'state' => 'Bihar', 'opd_days' => 'Mon - Sat', 'timing_from' => '08:00 AM', 'timing_to' => '12:00 PM'],
            ['id' => 16, 'name' => 'Dr. Deepa Krishnan', 'specialization' => 'Ophthalmology', 'state' => 'Tamil Nadu', 'opd_days' => 'Tue - Sat', 'timing_from' => '10:00 AM', 'timing_to' => '04:00 PM'],
            ['id' => 17, 'name' => 'Dr. Arun Bhatt', 'specialization' => 'General Medicine', 'state' => 'Gujarat', 'opd_days' => 'Mon - Fri', 'timing_from' => '09:00 AM', 'timing_to' => '01:00 PM'],
            ['id' => 18, 'name' => 'Dr. Ritu Saxena', 'specialization' => 'Pediatrics', 'state' => 'Rajasthan', 'opd_days' => 'Mon, Wed, Fri', 'timing_from' => '02:00 PM', 'timing_to' => '06:00 PM'],
        ];

        $states = collect($doctors)->pluck('state')->unique()->sort()->values()->toArray();
        $specializations = collect($doctors)->pluck('specialization')->unique()->sort()->values()->toArray();

        return view('pages.opd-timings', compact('doctors', 'states', 'specializations'));
    }
}
