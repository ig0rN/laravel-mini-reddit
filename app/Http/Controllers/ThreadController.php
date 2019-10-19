<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Http\Requests\ThreadRequest;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Thread::all();
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
        
        return $thread;
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
        return $thread->addComment($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        return $thread;
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
        if($thread->user == $request->user) {
            if($thread->canEdit()){
                $thread->update($request->all());

                return $thread;
            }
            return false;
        }

        return response(false, 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        if($thread->user == $request->user) {
            $thread->delete();

            return true;
        }

        return response(false, 401);
    }
}
