<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LandingController extends Controller
{
    public function index()
    {
        // Fetch only backend-stored, verified doctors (no fake data).
        $doctors = [];
        try {
            $response = Http::timeout(10)->get(config('services.telemartmain.api_url') . '/doctors');
            if ($response->successful()) {
                $doctors = $response->json('doctors', []);
            }
        } catch (\Throwable $e) {
            $doctors = [];
        }

        // Base URL for building doctor profile-image links served from the backend.
        $imageBaseUrl = rtrim(config('services.telemartmain.base_url'), '/') . '/storage/';

        return view('pages.landing', compact('doctors', 'imageBaseUrl'));
    }
}
