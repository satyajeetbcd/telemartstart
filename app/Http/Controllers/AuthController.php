<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('api_token')) {
            return redirect()->route('patient.dashboard');
        }

        return view('auth.patient-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        try {
            $response = Http::timeout(10)->post(config('services.telemartmain.api_url') . '/patient/login', [
                'email' => $request->email,
                'password' => $request->password,
            ]);

            if ($response->successful()) {
                $data = $response->json();

                session([
                    'api_token' => $data['token'],
                    'patient' => $data['patient'],
                ]);

                return redirect()->route('patient.dashboard');
            }

            $errorMessage = $response->json('message', 'Invalid credentials. Please try again.');
            return back()->withErrors(['email' => $errorMessage])->withInput($request->only('email'));
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Unable to connect to the server. Please try again later.'])->withInput($request->only('email'));
        }
    }

    public function showRegister()
    {
        if (session('api_token')) {
            return redirect()->route('patient.dashboard');
        }

        return view('auth.patient-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $response = Http::timeout(10)->post(config('services.telemartmain.api_url') . '/patient/register', [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
            ]);

            if ($response->successful()) {
                $data = $response->json();

                session([
                    'api_token' => $data['token'],
                    'patient' => $data['patient'],
                ]);

                return redirect()->route('patient.dashboard')->with('success', 'Registration successful! Welcome to Tele Health Mart.');
            }

            $errors = $response->json('errors', []);
            $message = $response->json('message', 'Registration failed. Please try again.');

            return back()->withErrors($errors ?: ['email' => $message])->withInput($request->except('password', 'password_confirmation'));
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Unable to connect to the server. Please try again later.'])->withInput($request->except('password', 'password_confirmation'));
        }
    }

    public function logout(Request $request)
    {
        $token = session('api_token');

        if ($token) {
            try {
                Http::withToken($token)->timeout(5)->post(config('services.telemartmain.api_url') . '/patient/logout');
            } catch (\Exception $e) {
                // Silently fail - we still want to clear the local session
            }
        }

        $request->session()->forget(['api_token', 'patient']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }
}
