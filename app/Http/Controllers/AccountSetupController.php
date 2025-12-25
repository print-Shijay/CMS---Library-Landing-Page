<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountSetupController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        // Decode JSON if it exists, or provide empty defaults
        $socials = $user->social_media ? json_decode($user->social_media, true) : [];
        
        return view('auth.setup-account', compact('user', 'socials'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'required|min:8|confirmed', // "confirmed" expects password_confirmation field
            'age' => 'required|integer|min:18',
            'sex' => 'required|in:Male,Female,Other',
            'phone_number' => 'required|string|max:20',
            'social_media.facebook' => 'nullable|url',
            'social_media.twitter' => 'nullable|url',
            'social_media.instagram' => 'nullable|url',
            'social_media.github' => 'nullable|url',
            'social_media.linkedin' => 'nullable|url',
        ]);

        // Update User
        $user->forceFill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'age' => $validated['age'],
            'sex' => $validated['sex'],
            'phone_number' => $validated['phone_number'],
            'social_media' => json_encode($validated['social_media']), // Store as JSON
            'email_verified_at' => now(), // THE TRIGGER: Marks account as active
        ])->save();

        return redirect()->route('admin.dashboard')->with('success', 'Account setup complete! Welcome.');
    }
}