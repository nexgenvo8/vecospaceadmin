<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{


    // public function showLoginForm()
    // {
    //     return view('login');
    // }

    // public function Login(Request $request)
    // {
    //     $apiUrl = env('API_URL') . '/api/adminlogin';
    //     // API call with user input
    //     $response = Http::post($apiUrl, [
    //         'userId' => $request->userId,
    //         'password' => $request->password,
    //     ]);

    //     // Handle response
    //     if ($response->successful()) {
    //         $data = $response->json();

    //         // 🔐 Save user/token in session
    //         Session::put('token', $data['token']);
    //         // Session::put('user', $data['user']); // if available

    //         return redirect()->route('index'); // redirect to dashboard or home
    //     } else {
    //         return redirect()->back()->with('error', 'Invalid credentials or API error');
    //     }
    // }





}

