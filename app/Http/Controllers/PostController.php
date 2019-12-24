<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $status = 'fail';
        if (!empty($posts)) {
            $status = 'success';
        }
        return response()->json(compact('posts', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->title = $request->get('title');
        $post->text = $request->get('text');
        $post->author = $request->get('author');
        if ($post->save()) {
            return response()->json(['post' => $post, 'status' => 'success']);
        }
        return response()->json(['status' => 'failed']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return response()->json(['post' => $post, 'status' => 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $post = Post::find($id);
        $post->title = $request->get('title');
        $post->text = $request->get('text');
        $post->author = $request->get('author');
        $post->update();
        return response()->json(['post' => $post, 'status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Post::destroy($id)) {
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'failed']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPostsPaginate()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(10);
        $status = !empty($posts) ? 'success' : 'fail';
        return response()->json(compact('posts', 'status'));
    }
}
