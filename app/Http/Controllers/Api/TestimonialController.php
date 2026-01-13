<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    // Public: Get testimonials
    // Logic: Show ALL 'Approved' reviews + 'Pending' reviews belonging to the current user (if logged in)
    public function index(Request $request)
    {
        // 1. Try to get the user from the token (Sanctum guard)
        // We use the guard directly because this route is public and might not have the auth middleware
        $user = Auth::guard('sanctum')->user();

        $query = Testimonial::with('user:id,name,avatar');

        if ($user) {
            // Logged in: Show Approved OR (My Pending Reviews)
            $query->where(function($q) use ($user) {
                $q->where('is_approved', true)
                  ->orWhere(function($subQ) use ($user) {
                      $subQ->where('user_id', $user->id)
                           ->where('is_approved', false);
                  });
            });
        } else {
            // Guest: Show ONLY Approved
            $query->where('is_approved', true);
        }

        // 2. Sorting Logic
        switch ($request->sort) {
            case 'rating_desc':
                $query->orderBy('rating', 'desc');
                break;
            case 'rating_asc':
                $query->orderBy('rating', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        return $query->get();
    }

    // Protected: Create
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Default: is_approved = false (Pending)
        $testimonial = Auth::user()->testimonials()->create($request->all());

        return response()->json($testimonial, 201);
    }

    // Protected: Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $testimonial = Auth::user()->testimonials()->findOrFail($id);

        // SECURITY: Only allow editing if it is NOT approved (Pending)
        if ($testimonial->is_approved) {
            return response()->json([
                'message' => 'Approved testimonials cannot be edited. Please delete and repost.'
            ], 403);
        }
        
        $testimonial->update([
            'content' => $request->content,
            'rating' => $request->rating,
            // Note: We do not reset is_approved here, usually edits to pending items stay pending.
        ]);

        return response()->json($testimonial);
    }

    // Protected: Delete
    public function destroy($id)
    {
        $testimonial = Auth::user()->testimonials()->findOrFail($id);
        $testimonial->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}