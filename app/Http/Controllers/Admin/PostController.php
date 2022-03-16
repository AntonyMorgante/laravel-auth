<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;

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
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:100',
            'content'=>'required'
        ]);

        $form_data=$request->all();

        $post = new Post();   
        
        //slug
        $slugTitle= Str::slug($form_data['title']);
        $count = 2;
        while(Post::where('slug',$slugTitle)->first()){
            $slugTitle=Str::slug($form_data['title'])."-".$count;
            $count++;
        }
        $form_data['slug'] = $slugTitle;

        $form_data['published'] = true;
        $post = Post::create($form_data);

        $post->save();

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=>'required|string|max:100',
            'content'=>'required'
        ]);

        $form_data=$request->all();
        
        //slug
        if($form_data['title'] == $post->title){
            $count = 2;
            $slugTitle= Str::slug($form_data['title']);
            while(Post::where('slug',$slugTitle)->first()){
                $slugTitle=Str::slug($form_data['title'])."-".$count;
                $count++;
            }
            $form_data['slug'] = $slugTitle;
        }

        $post->update($form_data);

        return redirect()->route('admin.posts.show',compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with(["message"=>"Il tuo post è stato eliminato!"]);
    }
}
