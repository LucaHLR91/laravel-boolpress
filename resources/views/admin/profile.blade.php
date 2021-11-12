@extends('layouts.dashboard')

@section('title', 'Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               <div class="card-header">I tuoi dati</div>
               <div class="card-body">
                   <div>{{ Auth::user()->name }}</div>
                   <div>{{ Auth::user()->email }}</div>
                   {{-- SE ESISTE FACCIO VEDERE L'API TOKEN, SE NON ESISTE RENDERIZZO UN BOTTONE PER FARE RICHIESTA --}}
                   @if (Auth::user()->api_token) {
                       <div>API Token: {{ Auth::user()->api_token }}</div>
                   }@else {
                        <form action="{{ route('admin.generate_token') }}" method="post">
                            @csrf
                            @method('POST')

                            <button type="submit" class="btn btn-primary">Genera API</button>
                        </form>
                   }
                   @endif
               </div>
            </div>
        </div>
    </div>
</div>
@endsection