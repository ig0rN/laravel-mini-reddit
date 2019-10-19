<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Http\Requests\ThreadRequest;
use App\Http\Requests\CommentRequest;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status'  => 200,
            'message' => '',
            'data'    => Thread::all()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ThreadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThreadRequest $request)
    {
        $thread = $request->user()->threads()->create($request->all());
        
        return response()->json([
            'status'  => 200,
            'message' => 'You have successfully created a new thread.',
            'data'    => $thread
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CommentRequest  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function reply(CommentRequest $request, Thread $thread)
    {
        return response()->json([
            'status'  => 200,
            'message' => 'You have successfully added your comment to thread.',
            'data'    => $thread->addComment($request->all())
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        return response()->json([
            'status'  => 200,
            'message' => '',
            'data'    => $thread
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ThreadRequest  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(ThreadRequest $request, Thread $thread)
    {
        if($thread->user->id == auth()->user()->id) {
            if($thread->canEdit()){
                $thread->update($request->all());

                return response()->json([
                    'status'  => 200,
                    'message' => 'You have successfully updated the thread.',
                    'data'    => $thread
                ], 200);
            }

            return response()->json([
                'status'  => 417,
                'message' => 'Allowed time for edit the thread is 6 hours after you created it.',
                'data'    => []
            ], 417);
        }

        return response()->json([
            'status'  => 401,
            'message' => 'You can only update the posts you created.',
            'data'    => []
        ], 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        if($thread->user->id == auth()->user()->id) {
            foreach($thread->comments as $comment){
                $comment->delete();
            }
            $thread->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'You have successfully deleted the thread and all comments related to it.',
                'data'    => []
            ], 200);
        }

        return response()->json([
            'status'  => 401,
            'message' => 'You can only delete the posts you created.',
            'data'    => []
        ], 401);
    }
}
