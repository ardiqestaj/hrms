<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Post;
use DB;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('posts')
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->select('users.avatar', 'users.name', 'posts.*')
        ->latest()->paginate(6); 
        // $posts = Post::latest()->paginate(10);
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
        $request->validate([
            'title'   => 'required|string|max:255',
            'description'        => 'required|string|max:255',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        if ($request->filled('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $path =  $request->file('image')->move(public_path('assets/images/posts'), $image);
        } else {
            $image = "NULL";
        }
      
        DB::beginTransaction();
        try {

            $post = new Post;
            $post->user_id       = $request->user_id;
            $post->title         = $request->title;
            $post->description   = $request->description;
            $post->body          = $request->body;
            $post->image          = $image;
            $post->save();
            
            DB::commit();
            Toastr::success('Create new Post successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Post fail :)','Error');
            return redirect()->back();
        }
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
