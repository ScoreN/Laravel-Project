<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filters\PostFilter;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PostUserLikes;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::select('posts.*', 'users.*', 'categories.*', 'posts.created_at as post_created')
                ->join('users','author_id','=','users.id')
                ->join('categories','categ_id','=','categories.category_id')
                ->orderBy('posts.created_at','desc')->get();
        $categories = Category::all();
        return view('posts.index',compact('posts','categories'));
    }

    public function search(PostFilter $request)
    {
        $posts = Post::select('posts.*', 'users.*', 'categories.*', 'posts.created_at as post_created')
                 ->join('users','author_id','=','users.id') 
                 ->join('categories','categ_id','=','categories.category_id')
                 ->filter($request)
                 ->orderBy('posts.created_at','desc')
                 ->get();
        $categories = Category::all();
        return view('posts.index',compact('posts','categories'));
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
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->author_id = \Auth::user()->id;
        $post->post_name = $request->postName;
        $post->content = $request->Content;
        $post->categ_id = $request->categoryAdd;

        if ($request->file('Img'))
        {
            $path = Storage::putFile('public',$request->file('Img'));
            $url = Storage::url($path);
            $post->img_url = $url;
        }

        $post->save();
        return redirect('/')->with('success','Пост создан с уникальным идентификатором '.$post->post_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::select('posts.*', 'users.*', 'categories.*', 'posts.created_at as post_created')
                ->join('users','author_id','=','users.id')
                ->join('categories','categ_id','=','categories.category_id')
                ->orderBy('posts.created_at','desc')
                ->find($id);
        $comment = Comment::select('posts.*', 'users.*', 'comments.*', 'comments.created_at as comm_created')
                ->join('users','comm_user_id','=','users.id')
                ->join('posts','comm_post_id','=','posts.post_id')
                ->where('comm_post_id','=',$id)
                ->orderBy('comments.created_at','desc')->get();
        $like = PostUserLikes::where('like_post_id','=',$id);
        $categories = Category::all();
        if (!$post)
        {
            return view('errors.404');
        }
        return view('posts.view',compact('post','comment','like','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        if (!$post)
        {
            return view('errors.404');
        }
        if(\Auth::user()->id != $post->author_id)
        {
            return redirect()->route('index')->withErrors('Вы не можете изменить этот пост');
        }
        $post->post_name = $request->postName;
        $post->content = $request->Content;
        $post->categ_id = $request->categoryAdd;

        if ($request->file('Img'))
        {
            $path = Storage::putFile('public',$request->file('Img'));
            $url = Storage::url($path);
            $post->img_url = $url;
        }

        $post->update();
        return redirect()->route('view',compact('id'))->with('success','Пост с уникальным идентификатором '.$post->post_id.' изменён.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $comment = Comment::where('comm_post_id','=',$id);
        if (!$post)
        {
            return view('errors.404');
        }
        if(\Auth::user()->id != $post->author_id)
        {
            return redirect()->route('index')->withErrors('Вы не можете удалить этот пост');
        }
        auth()->user()->LikedPosts()->detach($id);
        $comment->delete();
        $post->delete();
        return redirect()->route('index')->with('success','Пост с уникальным идентификатором '.$post->post_id.' удалён.');
    }
}
