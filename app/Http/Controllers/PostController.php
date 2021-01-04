<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Purifier;
use Gate;
use Response;
use Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = auth()->user();
        $posts = Post::where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->paginate(6);

        //return a view and pass in the above variable
        return view('posts.index')->withPosts($posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, array(
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
        ));

        // store in the database
        $post = new Post();
        $post->fill($request->all());

        $post->user_id = auth()->user()->id;

        $post->save();

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->getClientOriginalName();
            $fileName = pathinfo($thumbnail, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('thumbnail')->move(public_path('images'), $fileName);

            $post->image()->create(['url' => asset('images/' . $fileName)]);
        } else {
            $post->image()->create(['url' => asset('images/default.jpg')]);
        }

        // Creating flash message(the variable flash exists for one request and in the next request is deleted) for successful publication
        Session::flash('postSuccess', '');

        // redirect to another page
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        $this->authorize('permission', $post);

        return view('posts.show')->withPost($post);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find the post in the database and save as a var
        $post = Post::find($id);

        $this->authorize('permission', $post);

        //return the view and pass in the var we previously created
        return view('posts.edit')->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $this->authorize('permission', $post);

        //Validate the data
        $this->validate($request, array(
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
        ));

        //Save the data to the database
        $post->fill($request->all());

        $post->save();

        //Set flash data with success message
        Session::flash('postUpdateSuccess', '');

        //Redirect with flash data to the show request
        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete the post
        $post = Post::find($id);

        $this->authorize('permission', $post);

        $post->delete();

        //Set flash data with success message
        Session::flash('postDeleteSuccess', '');

        //Redirect with flash data to the index request
        return redirect()->route('posts.index');
    }
}
