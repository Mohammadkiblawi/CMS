<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function index()
    {
        $posts = $this->post::with('user', 'category')->paginate(10);
        return view('admin.posts.all', compact('posts'));
    }
    public function edit($id)
    {

        $post = $this->post::find($id);
        return view('admin.posts.edit', compact('post'));
    }
    public function update(Request $request, $id)
    {
        $request['approved'] = $request->has('approved'); //returns true or false
        $this->post->find($id)->update($request->all());
        return back()->with('success', trans('alerts.success'));
    }
}
