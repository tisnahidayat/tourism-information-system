<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Post',
            'post' => Post::paginate(12)->withQueryString()
        ];

        return view('frontend.blog.index', $data);
    }

    public function detail(Post $blog)
    {
        return view('frontend.blog.detail', [
            'title' => 'Post',
            'post' => $blog
        ]);
    }
}
