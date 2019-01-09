<?php

namespace App\Http\Controllers;

use App\Corpus;
use App\Text;
use App\Categoria;
use Illuminate\Http\Request;

class CorpusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::paginate(10);

        return view('corpus.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();

        return view('corpus.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $corpus = new Corpus;
        $corpus->categoria_id = $request->categoria_id;
        $corpus->titulo = $request->titulo;
        $corpus->descricao = $request->descricao;
        $corpus->save();

        return redirect('/corpus');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Corpus  $corpus
     * @return \Illuminate\Http\Response
     */
    public function show(Corpus $corpus)
    {
        return view('corpus.show',compact('corpus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Corpus  $corpus
     * @return \Illuminate\Http\Response
     */
    public function edit(Corpus  $corpus)
    {
        $categorias = Categoria::all();

        return view('corpus.edit',compact('corpus','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Corpus  $corpus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Corpus  $corpus)
    {
        $corpus->categoria_id = $request->categoria_id;
        $corpus->titulo = $request->titulo;
        $corpus->descricao = $request->descricao;
        $corpus->save();

        return redirect("/corpus/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Corpus  $corpus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corpus  $corpus)
    {
        $corpus->delete();

        return redirect('/corpus/');
    }

    /**
     * Show the form for creating a new corpus.
     *
     * @return \Illuminate\Http\Response
     */
     public function createText($corpus_id)
    {
        return view('corpus.texts.create',compact('corpus_id'));
    }

    /**
     * Store a newly created corpus in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeText(Request $request, Corpus  $corpus)
    {
        $text = new Text;
        $text->idioma = $request->idioma;
        $text->conteudo = $request->conteudo;
        $text->corpus_id = $corpus->id;

        $corpus->texts()->save($text);

        return redirect("/corpus/$corpus->id/text");
    }

    /**
     * Display a listing of the corpus.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCorpus(Corpus  $corpus)
    {
        $corpus->texts = Text::where('corpus_id', '=', $corpus->id)->paginate(10);

        return view('corpus.texts.index', compact('corpus'));
    }

    /**
     * Update the specified corpus in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Corpus  $corpus
     * @param  \App\Text $text
     * @return \Illuminate\Http\Response
     */
    public function updateText(Request $request, Corpus  $corpus, Text $text)
    {
        $text->conteudo = $request->conteudo;
        $text->idioma = $request->idioma;
        $text->save();

        return redirect("/corpus/$corpus->id/text");
    }

    /**
     * Show the form for editing the specified corpus.
     *
     * @param  \App\Corpus  $corpus
     * @param  \App\Text $text
     * @return \Illuminate\Http\Response
     */
    public function editText(Corpus  $corpus, Text $text)
    {
        return view('corpus.texts.edit',compact('corpus','text'));
    }

    /**
     * Remove the specified corpus from storage.
     *
     * @param  \App\Corpus  $corpus
     * @param  \App\Text $text
     * @return \Illuminate\Http\Response
     */
    public function destroyText(Corpus  $corpus, Text $text)
    {
        $text->delete();

        return redirect("/corpus/$corpus->id/text");
    }

}