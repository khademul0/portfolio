<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $skills = \App\Models\Skill::where('is_published', true)->orderBy('sort_order')->get();
        $milestones = \App\Models\Milestone::where('is_published', true)->orderBy('sort_order')->get();
        $experiences = \App\Models\Experience::where('is_published', true)->orderBy('end_date', 'desc')->get();
        $featuredProjects = \App\Models\Project::with('category')->where('is_published', true)->where('is_featured', true)->latest()->take(3)->get();

        $heroImage = \App\Models\Setting::get('hero_image');

        $latestPosts = \App\Models\Post::where('is_published', true)->latest()->take(3)->get();

        return view('pages.home', [
            'featuredProjects' => $featuredProjects,
            'skills'           => $skills,
            'milestones'       => $milestones,
            'experiences'      => $experiences,
            'latestPosts'      => $latestPosts,
            'heroImage'        => $heroImage,
        ]);
    }
}
