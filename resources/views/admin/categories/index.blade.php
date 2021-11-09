@extends('layouts.dashboard')

@section('title', 'Categories')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-12">
                {{-- COMANDO GENERALE PER STAMPARE IL RISULTATO DI UNA OPERAZIONE DI CREAZIONE, CANCELLAZIONE ECC, POTREI NEI METODI WITH DEFINIRE NOMI DIVERSI E DARE CLASSI DIVERSE PER CAMBIARE COLORE AL MESSAGGIO  --}}
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td scope="row">{{ $category['id'] }}</td>
                                <td>{{ $category['name'] }}</td>
                                <td>{{ $category['slug'] }}</td>
                                <td>
                                    @if ($category->category)
                                        {{ $category->category->name }} 
                                    @endif    
                                </td>
                                <td>
                                    <a href="{{ route('admin.categories.show', $category->id )}}" class="btn btn-info">Details</a>
                                    <a href="" class="btn btn-warning">Edit</a>
                                    <form action="" class="d-inline-block delete-post" method="post">
                                        @csrf
                                        @method('DELETE')
                                        {{-- LA CLASSE DELETE-POST CI SERVIRA PER RICHIEDERE CONFERMA DI CANCELLAZIONE TRAMITE IL JS, NON AVRA NULLA DI CSS  --}}
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