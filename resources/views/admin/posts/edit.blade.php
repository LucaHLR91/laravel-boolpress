@extends('layouts.dashboard')

@section('title', 'Modifica Post')
    
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Modifica post</h1>
            <form action="{{ route('admin.posts.update', $post['id']) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Titolo</label>
                    <input type="text" name="title" id="title" value="{{ $post['title'] }}" placeholder="Inserisci titolo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="content">Contenuto</label>
                    <textarea name="content" id="content" class="form-control" placeholder="Inserisci il contentuto">{!! $post['content'] !!}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Modifica Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection