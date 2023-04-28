@extends('layouts.main')
@section('content')
    <div class="mb-3">
        <div>{{ $post->id }}. {{ $post->title }}</div>
        <div>{{ $post->content }}</div>
    </div>
    <div class="d-flex gap-3">
        <div>
            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success mb-3">Edit</a>
        </div>
        <div>
            <form action="{{ route('post.destroy', $post->id) }}" method="post">
                @csrf
                @method('delete')
                <input type="submit" value="Delete" class="btn btn-danger">
            </form>
        </div>
        <div>
            <a href="{{ route('post.index') }}" class="btn btn-dark">Back</a>
        </div>
    </div>
@endsection
