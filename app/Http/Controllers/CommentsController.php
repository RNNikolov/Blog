<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Session;
use Response;
use Validator;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $json = [];

        if ($request->ajax()) {

            $validator = Validator::make($request->all(), ['comment' => 'required|min:5|max:300']);

            if ($validator->fails()) {
                $json['success'] = false;
                $json['errors'] = $validator->errors();
            }

            if (!$json) {
                $post = Post::find($post_id);

                $comment = new Comment();
                $comment->comment = $request->get('comment');
                $comment->post()->associate($post);
                $comment->user_id = auth()->user()->id;

                $comment->save();
                $json['success'] = true;
                $json['message'] = "Your comment has been posted";
                $json['reload'] = true;
            }
        }

        return Response::json($json);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        $this->authorize('permission', $comment);
        return view('comments.edit')->withComment($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function blogEdit($id)
    {
        $comment = Comment::find($id);
        return view('comments.blogEdit')->withComment($comment);
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
        $json = [];

        if ($request->ajax()) {

            $validator = Validator::make($request->all(), ['comment' => 'required|min:5|max:300']);

            if ($validator->fails()) {
                $json['success'] = false;
                $json['errors'] = $validator->errors();
            }

            if (!$json) {
                $comment = Comment::find($id);

                $comment->comment = $request->input('comment');

                $comment->save();
                $json['success'] = true;
                $json['message'] = "Your comment has been updated";
                $json['redirect'] = true;
            }
        }

        return Response::json($json);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        $comment->delete();
        return response()->json(['status' => 'The comment has been deleted successfully']);
    }
}
