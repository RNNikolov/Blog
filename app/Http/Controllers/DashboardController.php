<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Session;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('can:manage-posts-comments');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderby('created_at', 'desc')->paginate(6);

        //return a view and pass in the above variable
        return view('dashboard')->withPosts($posts);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete the post
        $post = Post::find($id);
        $post->delete();

        //Set flash data with success message
        Session::flash('postDeleteSuccess', '');

        //Redirect with flash data to the index request
        return redirect()->route('dashboard');
    }

}
