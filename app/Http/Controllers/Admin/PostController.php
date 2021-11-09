<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;

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
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // VALIDAZIONE DATI PROVENIENTI DAL FORM
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required', 
            'category_id' => 'exists:categories,id'
        ]);
        // RICHIEDO I DATI AL FORM PER COMPORRE IL MIO NUOVO POST
        
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
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (!$post) {
            abort(404);
        }

        $categories = Category::all();

        // IN QUESTO CASO IL COMPACT PASSANDOGLI DUE PARAMETRI CI VA A FARE UNA COSA DI QUESTO TIPO
        // $data = [
        //     'post' => $post,
        //     'categories' => $categories
        // ];
        
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // VALIDO I DATI
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required', 
        ]);
        
        $form_data = $request->all();
        //VERIFICO SE IL TITOLO RICEVUTO NELLA MODIFICA E' UGUALE AL PRECEDENTE
        if ($form_data['title'] != $post['title']) {
            // E' STATO MODIFICATO IL TITOLO QUINDI DEVO MODIFICARE LO SLUG
            $slug = Str::slug($form_data['title'], '-');
        
            $slug_presente = Post::where('slug', $slug)->first();
        
            $contatore = 1;
            while ($slug_presente) {
                $slug = $slug . '-' . $contatore;
            
                $slug_presente = Post::where('slug', $slug)->first();
                $contatore++;
            };

            $form_data['slug'] = $slug;
        }

        $post->update($form_data);

        return redirect()->route('admin.posts.index')->with('status', 'Post correttamente aggiornato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Post eliminato');
    }
}
