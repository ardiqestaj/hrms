<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        // dd($posts);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function create(Request $request)
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     Post::create(array_merge($request->only('title', 'description', 'body'),[
    //         'user_id' => auth()->id()
    //     ]));

    //     return response()->json(['redirectTo' => '/posts']);
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Post  $post
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Post $post)
    // {
    //     return view('posts.show', [
    //         'post' => $post
    //     ]);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Post  $post
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Post $post)
    // {
    //     $post->update($request->only('title', 'description', 'body'));

    //     return response()->json(['redirectTo' => '/posts']);
    // }

    /**
     * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Post  $post
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy(Post $post)
    {
        // $post->delete();

        // return redirect()->route('posts.index')
        //     ->withSuccess(__('Post deleted successfully.'));
    }
}