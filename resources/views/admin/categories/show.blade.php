@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Visualizzazione Categoria {{ $category['id'] }}</h1>
                <h2>{{ $category['name'] }}</h2>
                <small>Lo slug è: {{ $category['slug'] }}</small>
            </div>
            {{-- VADO A STAMPARE TUTTI I POST COLLEGATI ALLA CATEGORIA  E RENDO POSSIBILE VEDERNE I DETTAGLI --}}
            <div class="col-12 mt-4">
                <h2>Lista dei post collegati alla Categoria</h2>
                <ul>
                    @forelse ($category->posts as $post)
                        <li><a href="{{ route('admin.posts.show', $post['id'])}}">{{ $post['title'] }}</a></li>
                    @empty
                        <p>Nessun post collegato</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection