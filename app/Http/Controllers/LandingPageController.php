<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandingPage;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class LandingPageController extends Controller
{
    // GET /landing/preview
    public function preview(Request $request)
    {
        $page = LandingPage::find(1);
        $dbData = $page ? $page->toArray() : [];
        $inputs = $request->all();

        // Fetch the 3 admins for the staff section
        $staff = User::where('role', 'admin')->limit(3)->get();

        // Preserve DB image if no new image is provided in preview
        if (empty($inputs['image'])) {
            unset($inputs['image']);
        }

        // 1. Merge DB data with user inputs
        $previewData = array_merge($dbData, $inputs);

        // 2. Add the staff to the data array so the view can see it
        $previewData['staff'] = $staff;

        // Ensure related_links is an array
        if (isset($previewData['related_links'])) {
            $previewData['related_links'] = is_array($previewData['related_links'])
                ? $previewData['related_links']
                : json_decode($previewData['related_links'], true) ?? [];
        }

        return response()
            ->view('templates.' . ($request->template ?? 'default'), $previewData)
            ->header('Access-Control-Allow-Origin', '*');
    }

    // POST /landing/save
    public function save(Request $request)
    {
        $page = LandingPage::find(1) ?? new LandingPage(['id' => 1]);


        $data = $request->only([
            'template',
            'title',
            'description',
            'button',
            'mission',
            'vision',
            'goals',
            'related_links'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($page->image) {
                Storage::disk('public')->delete($page->image);
            }

            $path = $request->file('image')->store('landing', 'public');
            $data['image'] = $path;
        }

        LandingPage::updateOrCreate(['id' => 1], $data);

        return response()->json(['status' => 'saved']);
    }

    // GET /landing
    public function show()
    {
        $page = LandingPage::find(1);
        $staff = User::where('role', 'admin')->limit(3)->get();

        if (!$page) {
            return response('No page published yet', 404);
        }

        return response()
            ->view('templates.' . $page->template, [
                ...$page->toArray(),
                'staff' => $staff
            ])
            ->header('Access-Control-Allow-Origin', '*');
    }
}
