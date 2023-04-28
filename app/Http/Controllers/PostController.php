<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post = Post::query()->create($data);
        $post->tags()->withTimeStamps()->attach($tags);

        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->withTimeStamps()->sync($tags);
        return redirect()->route('post.show', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }


    public function delete()
    {
        $post = Post::withTrashed()->find(1);
        $post->delete();

        dd('deleted');
    }

    public function firstOrCreate()
    {
        $anotherPost = [
            'title' => 'some post phpstorm',
            'content' => 'some interesting content',
            'likes' => '30',
            'is_published' => '1',
        ];
        $post = Post::query()->firstOrCreate([
            'title' => 'title of post phpstorm'
        ], [
            'title' => 'some post phpstorm',
            'content' => 'some interesting content',
            'likes' => '30',
            'is_published' => '1',
        ]);
        dump($post->content);
        dd('finished');
    }

    public function updateOrCreate()
    {
        $anotherPost = [
            'title' => 'update or create post phpstorm',
            'content' => 'update or create interesting content',
            'likes' => '30',
            'is_published' => '1',
        ];
        $post = Post::query()->updateOrCreate([
            'title' => 'some post phpstorm'
        ], [
            'title' => 'some post phpstorm',
            'content' => 'update or create interesting content',
            'likes' => '30',
            'is_published' => '1',
        ]);
    }
}
