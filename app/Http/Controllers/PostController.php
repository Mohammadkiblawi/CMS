<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Traits\ImageUpload;


class PostController extends Controller
{
    use ImageUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function index()
    {
        $posts =  $this->post::with('user:id,name')->approved()->latest()->paginate(10);

        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $image_name = $this->uploadImage($request->image);
        }
        $request->user()->posts()->create($request->all() + ['image_path' => $image_name ?? 'photo.png']);
        // $this->post->create($request->all()+['user_id'=>$request->user()->id]);
        return back()->with('success', trans('alerts.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->post->find($id);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->post->find($id);
        if (auth()->user()->can('edit-post', $post)) {
            return view('post.edit', compact('post'));
        } else {
            abort(403);
        }
        //or abort_unless(auth()->user()->can('edit-post', $post),403);
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
        if ($request->hasFile('image')) {
            $request->user()->posts()->find($id)->update($request->all() + ['image_path' => $this->uploadImage($request->image)]);
        } else {
            $request->user()->posts()->find($id)->update($request->all());
        }
        return back()->with('success', trans('alert.success'));

        // $this->post->find($id)->update($request->all()+['user_id'=>$request->user()->id]); 
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
    public function getByCategory($id)
    {
        $posts = $this->post::with('user:id,name')->whereCategoryId($id)->approved()->paginate(10);
        return view('index', compact('posts'));
    }
    public function search(Request $request)
    {
        $posts = $this->post->where('body', 'LIKE', '%' . $request->keyword . '%')->with('user:id,name')->approved()->paginate(10);
        return view('index', compact('posts'));
    }
}
