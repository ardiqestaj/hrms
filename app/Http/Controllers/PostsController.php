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
        $author = '';
        $date = '';
        $general = '';

        $posts = DB::table('posts')
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->select('users.avatar', 'users.name', 'posts.*')
        ->latest()->paginate(6); 
        // $posts = Post::latest()->paginate(10);
        // dd($posts);

        return view('posts.index', compact('posts', 'author', 'date', 'general'));
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
            $image = $request->file('image')->getClientOriginalName();
            $path =  $request->file('image')->move(public_path('assets/images/posts'), $image);

      
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
    public function show($post)
    {
        $posts = DB::table('posts')
        ->join('users', 'users.id', '=', 'posts.user_id')
        ->select('users.avatar', 'users.name', 'posts.*')
        ->where('posts.id', $post)->first();
        return view('posts.show', compact('posts'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if ($request->filled('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $path =  $request->file('image')->move(public_path('assets/images/posts'), $image);
        } else {
            $image = "NULL";
        }
        DB::beginTransaction();
        try {

            $update = [
                'title' => $request->title,
                'description' => $request->description,
                'body' => $request->body,
                'image' => $image

            ];

            Post::where('id', $request->id)->update($update);
            DB::commit();

            Toastr::success('Updated post successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Updated post fail :)', 'Error');
            return redirect()->back();
        }
    }
    // Post search
    public function SearchPost(Request $request)
    {
            // search by author
            $author = '';
            if ($request->author) {
                $posts = DB::table('posts')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->select('users.avatar', 'users.name', 'posts.*')
                ->where('users.name', 'LIKE', '%' . $request->author . '%')
                ->latest()->paginate(6); 
                $author = $request->author;

            }
            // search by date
            $date = '';
            if ($request->date) {
           $date = date('Y-m-d', strtotime($request->date));

                $posts = DB::table('posts')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->select('users.avatar', 'users.name', 'posts.*')
                ->where('posts.updated_at', 'LIKE', '%' . $date . '%')
                ->latest()->paginate(6); 
                $date = $request->date;
            }
            // search by general
            $general = '';
            if ($request->general) {
                $posts = DB::table('posts')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->select('users.avatar', 'users.name', 'posts.*')
                ->where('posts.title', 'LIKE', '%' . $request->general . '%')
                ->orWhere('posts.description', 'LIKE', '%' . $request->general . '%')
                ->orWhere('posts.body', 'LIKE', '%' . $request->general . '%')
                ->latest()->paginate(6); 
            $general = $request->general;

            }

            // search by author and date
            if ($request->author && $request->date) {
                $date = date('Y-m-d', strtotime($request->date));

                $posts = DB::table('posts')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->select('users.avatar', 'users.name', 'posts.*')
                ->where('users.name', 'LIKE', '%' . $request->author . '%')
                ->where('posts.updated_at', 'LIKE', '%' . $date . '%')
                ->latest()->paginate(6); 
            }
            // search by author and general
            if ($request->author && $request->general) {
                $posts = DB::table('posts')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->select('users.avatar', 'users.name', 'posts.*')
                ->where('users.name', 'LIKE', '%' . $request->author . '%')
                ->where('posts.title', 'LIKE', '%' . $request->general . '%')
                ->orWhere('posts.description', 'LIKE', '%' . $request->general . '%')
                ->orWhere('posts.body', 'LIKE', '%' . $request->general . '%')
                ->latest()->paginate(6); 
            }
            // search by date and general
            if ($request->date && $request->general) {
                $date = date('Y-m-d', strtotime($request->date));
                $posts = DB::table('posts')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->select('users.avatar', 'users.name', 'posts.*')
                ->where('posts.updated_at', 'LIKE', '%' . $date . '%')
                ->where('posts.title', 'LIKE', '%' . $request->general . '%')
                ->orWhere('posts.description', 'LIKE', '%' . $request->general . '%')
                ->orWhere('posts.body', 'LIKE', '%' . $request->general . '%')
                ->latest()->paginate(6); 
            }
            return view('posts.index', compact('posts', 'author', 'date', 'general'));
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
    public function delete(Request $request)
    {
        try {

            Post::destroy($request->id);
            Toastr::success('Post deleted successfully :)', 'Success');
        //     $posts = DB::table('posts')
        // ->join('users', 'users.id', '=', 'posts.user_id')
        // ->select('users.avatar', 'users.name', 'posts.*')
        // ->latest()->paginate(6);
        // return view('posts.index', compact('posts'));

            // return redirect()->back();
            return redirect()->route('posts');

        } catch (\Exception$e) {

            DB::rollback();
            Toastr::error('Post deleted fail :)', 'Error');
            return redirect()->back();
        }
    }
}
