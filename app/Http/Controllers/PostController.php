<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Cache;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function eloquent()
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
    public function eloquentcreate()
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
            echo "false";
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
            echo "false";
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
            echo "false";
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
        //     echo "delete false";
        // }
        $deleted = Post::destroy(33);
        if ($deleted) {
            echo "delete success";
            echo "<hr>";
            echo $deleted;
        } else {
            echo "delete false";
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
            echo "softdelete false";
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
            echo "recover false";
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
     * event
     */
    public function postevent()
    {
        $input = [
            'title' => 'test model event',
            'content' => 'content event',
            'user_id' => '1',
        ];
        $post = Post::create($input);
        if (!$post->exists) {
            echo "create post false";
            exit();
        } else {
            echo '&lt;' . $post->title . '&gt;create success';
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $posts = Cache::get('posts',[]);
    if(!$posts)
        exit('Nothing');

    $html = '<ul>';

    foreach ($posts as $key=>$post) {
        $html .= '<li><a href='.route('post.show',['post'=>$key]).'>'.$post['title'].'</li>';
    }

    $html .= '</ul>';

    return $html;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postUrl = route('post.store');
        $csrf_field = csrf_field();
        $html = <<<CREATE
            <form action="$postUrl" method="POST">
                $csrf_field
                <input type="text" name="title"><br/><br/>
                <textarea name="content" cols="50" rows="5"></textarea><br/><br/>
                <input type="submit" value="提交"/>
            </form>
CREATE;
    return $html;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');
        $post = ['title'=>trim($title),'content'=>trim($content)];

        $posts = Cache::get('posts',[]);
        
        if(!Cache::get('post_id')){
            Cache::add('post_id',1,60);
        }else{
            Cache::increment('post_id',1); 
        }
        $posts[Cache::get('post_id')] = $post;

        Cache::put('posts',$posts,60);
        return redirect()->route('post.show',['post'=>Cache::get('post_id')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Cache::get('posts',[]);
    if(!$posts || !$posts[$id])
        exit('Nothing Found！');
    $post = $posts[$id];

    $editUrl = route('post.edit',['post'=>$id]);
    $html = <<<DETAIL
        <h3>{$post['title']}</h3>
        <p>{$post['content']}</p>
        <p>
            <a href="{$editUrl}">编辑</a>
        </p>
DETAIL;

    return $html;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Cache::get('posts',[]);
    if(!$posts || !$posts[$id])
        exit('Nothing Found！');
    $post = $posts[$id];

    $postUrl = route('post.update',['post'=>$id]);
    $csrf_field = csrf_field();
    $html = <<<UPDATE
        <form action="$postUrl" method="POST">
            $csrf_field
            <input type="hidden" name="_method" value="PUT"/>
            <input type="text" name="title" value="{$post['title']}"><br/><br/>
            <textarea name="content" cols="50" rows="5">{$post['content']}</textarea><br/><br/>
            <input type="submit" value="提交"/>
        </form>
UPDATE;
    return $html;
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
        $posts = Cache::get('posts',[]);
    if(!$posts || !$posts[$id])
        exit('Nothing Found！');

    $title = $request->input('title');
    $content = $request->input('content');

    $posts[$id]['title'] = trim($title);
    $posts[$id]['content'] = trim($content);

    Cache::put('posts',$posts,60);
    return redirect()->route('post.show',['post'=>Cache::get('post_id')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Cache::get('posts',[]);
    if(!$posts || !$posts[$id])
        exit('Nothing Deleted！');

    unset($posts[$id]);
    Cache::decrement('post_id',1);

    return redirect()->route('post.index');
    }
}
