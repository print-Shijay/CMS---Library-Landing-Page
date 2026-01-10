<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandingPage;
use App\Models\User;
use App\Models\Announcement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class LandingPageController extends Controller
{
    // GET /landing/preview
    public function preview(Request $request)
    {
        $page = LandingPage::find(1);
        $dbData = $page ? $page->toArray() : [];
        $inputs = $request->all();

        // Fetch dynamic data
        $staff = User::where('role', 'admin')->limit(3)->get();
        $news = Announcement::latest()->limit(5)->get();

        // Preserve DB image if no new image is provided in preview
        if (empty($inputs['image'])) {
            unset($inputs['image']);
        }

        // 1. Merge DB data with user inputs
        // Note: $inputs['related_links'] comes as a JSON string from the frontend
        $previewData = array_merge($dbData, $inputs);

        // 2. Add dynamic sections
        $previewData['staff'] = $staff;
        $previewData['news'] = $news;

        // 3. Ensure related_links is always a valid PHP Array
        // This handles both the JSON string from the request AND the array from the DB
        if (isset($previewData['related_links'])) {
            $links = $previewData['related_links'];
            
            $previewData['related_links'] = is_array($links) 
                ? $links 
                : json_decode($links, true) ?? [];
        } else {
            $previewData['related_links'] = [];
        }

        return response()
            ->view('templates.' . ($request->template ?? 'default'), $previewData)
            ->header('Access-Control-Allow-Origin', '*');
    }

    // POST /landing/save
    public function save(Request $request)
    {
        // Find or instantiate the LandingPage
        $page = LandingPage::find(1) ?? new LandingPage(['id' => 1]);

        // Get basic fields
        $data = $request->only([
            'template',
            'title',
            'description',
            'button',
            'mission',
            'vision',
            'goals',
        ]);

        // 1. Handle Related Links
        // The frontend sends this as a JSON string: '[{"title":"...","url":"..."}]'
        // We decode it into an array so the Model (with $casts = ['related_links' => 'array']) can save it correctly.
        if ($request->has('related_links')) {
            $data['related_links'] = json_decode($request->related_links, true) ?? [];
        }

        // 2. Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($page->image) {
                Storage::disk('public')->delete($page->image);
            }

            $path = $request->file('image')->store('landing', 'public');
            $data['image'] = $path;
        }

        // 3. Save to Database
        LandingPage::updateOrCreate(['id' => 1], $data);

        return response()->json(['status' => 'saved']);
    }

    // GET /landing
    // GET /landing
    public function show()
    {
        $page = LandingPage::find(1);
        $staff = User::where('role', 'admin')->limit(3)->get();
        $news = Announcement::latest()->limit(5)->get();

        if (!$page) {
            return response('No page published yet', 404);
        }

        // Convert the page model to an array
        $data = $page->toArray();

        // FIX: Force decode related_links if it comes out of the DB as a string
        // This ensures the view always receives a PHP Array, not a JSON string.
        if (isset($data['related_links']) && is_string($data['related_links'])) {
            $data['related_links'] = json_decode($data['related_links'], true) ?? [];
        }

        // Ensure it defaults to an empty array if null
        if (!isset($data['related_links']) || is_null($data['related_links'])) {
            $data['related_links'] = [];
        }

        return response()
            ->view('templates.' . $page->template, array_merge($data, [
                'staff' => $staff,
                'news' => $news
            ]))
            ->header('Access-Control-Allow-Origin', '*');
    }

    public function fetchMetadata(Request $request)
    {
        $request->validate(['url' => 'required|url']);

        try {
            // Timeout after 5s to prevent hanging
            $response = Http::timeout(5)->get($request->url);
            $html = $response->body();

            // Simple regex to extract <title> content
            if (preg_match('/<title[^>]*>(.*?)<\/title>/ims', $html, $matches)) {
                $title = trim($matches[1]);
                // Decode HTML entities (e.g., &amp; -> &)
                $title = html_entity_decode($title); 
                return response()->json(['title' => $title]);
            }

            return response()->json(['title' => '']); // No title found
        } catch (\Exception $e) {
            return response()->json(['title' => ''], 200); // Fail silently
        }
    }
}
