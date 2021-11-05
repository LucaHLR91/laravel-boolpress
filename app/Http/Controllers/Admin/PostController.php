<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();
        $new_post = new Post();
        $new_post->fill($form_data);

        //GENERO LO SLUG TRAMITE UNA CLASSE LARAVEL STR E I SUOI METODI
        $slug = Str::slug($new_post['title'], '-');
        // VERIFICO SE LO SLUG SIA UNICO NEL SUO GENERE POICHE NEL DATABASE L HO IMPOSTATO COME UNICO
        $slug_presente = Post::where('slug', $slug)->first();
        // ISTANZIO UN CONTATORE NUMERICO CHE VERRÁ AGGIUNTO AL MIO SLUG BASE CON UN CICLO WHILE ANDANDO AD INCREMENTARE IL VALORE QUAL ORA ESSO SIA GIA PRESENTE
        $contatore = 1;
        while ($slug_presente) {
            $slug = $slug . '-' . $contatore;
            //VERIFICO SE NON HO UN POST CON LO STESSO SLUG ANCHE ALL INTERNO
            $slug_presente = Post::where('slug', $slug)->first();
            $contatore++;
        }

        $new_post->slug = $slug;
        $new_post->save();
        return redirect()->route('admin.posts.index')->with('status', 'Post inserito correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //PRESO POST CON DEPENDENCY INJECTION
        if (!$post) {
            abort(404);
        }
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
