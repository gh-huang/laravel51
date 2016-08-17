<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;

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
        // $posts = Post::where('id', '>', '28')->orderBy('id', 'asc')->take(3)->get();
        // Post::chunk(2, function ($posts) {
        //     foreach ($posts as $post) {
        //         echo $post->title . '<br>';
        //     }
        // });
        dd($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Post::create([
            'title' => 'testtitle', 
            'content' => 'testcontent', 
            'user_id' => '1'
        ]);
    }

    /**
     * save data form eloquent orm
     * 
     */
    public function savedata()
    {
        $post = new Post;
        $post->title = 'TitleTest';
        $post->content = 'test content';
        $post->user_id = 1;
        if ($post->save()) {
            echo "success";
        } else {
            echo "faile";
        }
    }

    /**
     * create data form eloquent orm create method
     */
    public function createdata()
    {
        $input = [
            'title' => 'TitleCreate',
            'content' => 'create content',
            'user_id' => '2',
        ];
        $post = Post::create($input);
        dd($post);
    }

    /**
     * update data form eloquent orm save method
     */
    public function updatedata()
    {
        $post = Post::find(33);
        $post->title = 'updatetitle';
        if ($post->save()) {
            echo "success";
        } else {
            echo "faile";
        }
    }

    /**
     * update data form eloquent orm update method
     */
    public function updatecreate()
    {
        $input = [
            'title' => 'testuptitle',
            'content' => 'updateconten',
        ];
        $post = Post::find(34);
        if ($post->update($input)) {
            echo "success";
        } else {
            echo "faile";
        }
    }

    /**
     * delete data form eloquent orm delete method
     */
    public function deletedata()
    {
        // $post = Post::find(34);
        // if ($post->delete()) {
        //     echo "delete success";
        // } else {
        //     echo "delete faile";
        // }
        $deleted = Post::destroy(33);
        if ($deleted) {
            echo "delete success";
            echo "<hr>";
            echo $deleted;
        } else {
            echo "delete faile";
        }
    }

    /**
     * softdelete data
     */
    public function softdelete()
    {
        $post = Post::find(32);
        $post->delete();
        if ($post->trashed()) {
            echo "softdelete success";
            dd($post);
        } else {
            echo "softdelete faile";
        }
    }

    /**
     * read softdelete data
     */
    public function withsoftdelete()
    {
        //select all include softdelete
        // $posts = Post::withTrashed()->get();
        //select softdelete
        $posts = Post::onlyTrashed()->get();
        dd($posts);
    }

    /**
     * recover softdelete data
     */
    public function recoversoftdelete()
    {
        $post = Post::withTrashed()->find(32);
        if ($post->restore()) {
            echo "recover success";
            dd($post);
        } else {
            echo "recover faile";
        }
    }

    /**
     * scope query
     */
    public function scope()
    {
        $posts = Post::popular()->orderBy('id', 'asc')->get();
        foreach ($posts as $post) {
            echo '&lt;' . $post->title . '&gt; ' . $post->user_id . '<br>';
        }
    }

    /**
     * scope query param
     */
    public function scopeparam()
    {
        $posts = Post::popular()->status(0)->orderBy('id', 'asc')->get();
        foreach ($posts as $post) {
            echo '&lt;' . $post->title . '&gt ' . $post->id . '  ' . $post->status . '<br>';
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
