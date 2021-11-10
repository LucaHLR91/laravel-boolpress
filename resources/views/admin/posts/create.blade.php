@extends('layouts.dashboard')
@section('title', 'Crea Post')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Creazione nuovo post</h1>
                <form action="{{ route('admin.posts.store') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="title">Titolo</label>
                        <input type="text" name="title" id="title" placeholder="Inserisci titolo" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Contenuto</label>
                        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" placeholder="Inserisci il contentuto">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_id">Categoria</label>
                        <select name="category_id" id="category_id" class="form-control @error('content') is-invalid @enderror">
                            <option value="">-->Seleziona<--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category['id']}}" {{ old('category_id') == $category['id'] ? 'selected' : NULL }}>{{ $category['name'] }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                   <div class="form-group">
                       <p>Seleziona i tag:</p>
                       @foreach ($tags as $tag)
                            <div class="form-check-inline form-check">
                                <input type="checkbox" name="tags[]" id="{{ 'tag' . $tag['id'] }}" value="{{ $Tag['id'] }}" class="form-check-input">
                                <label for="{{ 'tag' . $tag['id'] }}" class="form-check-label">{{ $tag['name'] }}</label>
                            </div>
                       @endforeach
                   </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Crea Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection