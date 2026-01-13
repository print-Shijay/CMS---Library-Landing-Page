<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        // Fetch all, sort by Pending first, then Newest
        $testimonials = Testimonial::with('user')
            ->orderBy('is_approved', 'asc') // 0 (Pending) comes before 1 (Approved)
            ->latest()
            ->get();

        return view('admin.testimonials', compact('testimonials'));
    }

    public function approve($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['is_approved' => true]);
        
        return redirect()->back()->with('success', 'Testimonial approved successfully.');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->back()->with('success', 'Testimonial deleted.');
    }
}