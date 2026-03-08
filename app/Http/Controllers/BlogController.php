<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function show($slug)
    {
        $post = \App\Models\Post::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('pages.post', compact('post'));
    }
}
