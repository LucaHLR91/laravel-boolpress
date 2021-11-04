@extends('layouts.dashboard')

@section('content')
    <ul>
        @foreach ($posts as $post)
            {{--    POSSO COMPORRE LA ROTTA CON L'ID, MA IN QUESTO CASO LO SLUG E' PIU PARLANTE QUINDI UTILIZZO LO SLUG, ESSENDO ANCHE ESSO UNIVOCO --}}
            <li><a href="{{ route('admin.posts.show', $post['id']) }}">{{ $post['title'] }}</a></li>
        @endforeach 
    </ul>
@endsection