<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Thread;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return response()->json([
            'status'  => 200,
            'message' => '',
            'data'    => $comment
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function reply(CommentRequest $request, Comment $comment)
    {
        return response()->json([
            'status'  => 200,
            'message' => 'You have successfully added your comment.',
            'data'    => $comment->addComment($request->all())
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if($comment->user->id == auth()->user()->id) {
            $comment->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'You have successfully deleted the comment.',
                'data'    => []
            ], 200);
        }

        return response()->json([
            'status'  => 401,
            'message' => 'You can only delete the comment you created.',
            'data'    => []
        ], 401);
    }
}
