<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $posts = Post::orderby('created_at', 'desc')->paginate(6);

        return view('blog.index')->withPosts($posts);
    }

    public function getSingle($id)
    {

        $post = Post::find($id);

        // return the view and pass in the post object
        return view('blog.single')->withPost($post);
    }
}
