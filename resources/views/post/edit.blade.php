@extends('layouts.main')
@section('content')
    <div>
        <form action="{{ route('post.update', $post->id) }}" method="post">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ $post->title }}">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" class="form-control" id="content">{{ $post->content }}</textarea>
            </div>
            <div class="mb-3">
                <label for="category" class="mb-3">Category
                    <select class="form-select" name="category_id">
                        @foreach($categories as $category)
                            <option
                                {{ $category->id === $post->category->id ? ' selected' : ''}}
                                value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="mb-3">
                <label for="tags">Tags</label>
                <select name="tags[]" class="form-select" multiple>
                    @foreach($tags as $tag)
                        <option
                            @foreach($post->tags as $postTag)
                                {{ $tag->id === $postTag->id ? ' selected' : ''}}
                            @endforeach
                            value="{{ $tag->id }}">{{ $tag->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
