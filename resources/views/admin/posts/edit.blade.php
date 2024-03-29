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
                    <input type="text" name="title" id="title" value="{{ old('title', $post['title']) }}" placeholder="Inserisci titolo" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Contenuto</label>
                    <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" placeholder="Inserisci il contentuto">{!! old('content', $post['content']) !!}</textarea>
                    @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">Categoria</label>
                    <select name="category_id" id="category_id" class="form-control @error('content') is-invalid @enderror">
                        <option value="">-->Seleziona<--</option>
                        @foreach ($categories as $category)
                            {{-- FACCIO NELL OLD UN CONTROLLO SE ESISTE PRIMA QUALCOSA DI SELEZIONATO CON IL POST->CATEGORY_ID, SENNO SALVO IN CASO DI ERRORE QUELLO CHE HO APPENA SELEZIONATO --}}
                            <option value="{{ $category['id']}}" {{ old('category_id', $post['category_id']) == $category['id'] ? 'selected' : NULL }}>{{ $category['name'] }}</option>
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
                            {{-- NELL'INPUT VERIFICO TRAMITE UN IF TERNARIO SE HO TAGS SELEZIONATI, SE CI SONO GLI ATTRIBUISCO IL CHECKED, UTILIZZO IL METODO CONTAINS PER VERIFICARE. CON L'OLD ANDIAMO A VEDERE INVECE SE C-ERA QUALCOSA DI SELEZIONATO, E MANTENERLO CON EVENTUALI ERRORI DI INSERIMENTO --}}
                            @if($errors->any())
                            <input {{ in_array($tag->id, old('tags', [])) ? 'checked' : NULL }} type="checkbox" name="tags[]" id="{{ 'tag' . $tag['id'] }}" value="{{ $tag['id'] }}" class="form-check-input">
                            <label for="{{ 'tag' . $tag['id'] }}" class="form-check-label">{{ $tag['name'] }}</label>
                            @else
                            <input {{ $post->tags->contains($tag->id) ? 'checked' : NULL }} type="checkbox" name="tags[]" id="{{ 'tag' . $tag['id'] }}" value="{{ $tag['id'] }}" class="form-check-input">
                            <label for="{{ 'tag' . $tag['id'] }}" class="form-check-label">{{ $tag['name'] }}</label>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Modifica Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection