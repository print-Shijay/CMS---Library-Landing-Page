<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;

class FaqController extends Controller
{
    // Public endpoint for the AI Chatbot to fetch knowledge
    public function index()
    {
        return Faq::where('is_active', true)
                  ->select('question', 'answer')
                  ->get();
    }
}