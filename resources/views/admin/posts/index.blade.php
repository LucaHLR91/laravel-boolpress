@extends('layouts.dashboard')

@section('title', 'Posts')

@section('content')
    {{-- <ul>
        @foreach ($posts as $post)
            {{--    POSSO COMPORRE LA ROTTA CON L'ID, MA IN QUESTO CASO LO SLUG E' PIU PARLANTE QUINDI UTILIZZO LO SLUG, ESSENDO ANCHE ESSO UNIVOCO --}}
            {{-- <li><a href="{{ route('admin.posts.show', $post['id']) }}">{{ $post['title'] }}</a></li> --}}
        {{-- @endforeach  --}}
    {{-- </ul> --}}
    
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td scope="row">{{ $post['id'] }}</td>
                                <td>{{ $post['title'] }}</td>
                                <td>{{ $post['slug'] }}</td>
                                <td>
                                    <a href="{{ route('admin.posts.show', $post['id']) }}" class="btn btn-info">Details</a>
                                    <a href="{{ route('admin.posts.edit', $post['id']) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('admin.posts.destroy', $post['id']) }}" class="d-inline-block" method="post">
                                        @csrf
                                        @method('DELETE')
                
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    
@endsection