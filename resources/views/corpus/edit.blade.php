@extends('master')

@section('content')
  <div class="row fluid">
    <div class="col">
      <a href="/corpus/{{ $corpus->id }}/text/"  class="btn btn-success">Listar Textos</a>
      <a href="/corpus/{{ $corpus->id }}/text/create"  class="btn btn-success">Adicionar Texto</a>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <form method="POST" action="/corpus/{{ $corpus->id  }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <div class="form-group mt-2">
          <label for="categoria_id">Categoria</label>
          <select name="categoria_id" class="custom-select" required>
            @foreach ($categorias as $categoria)
              <option value="{{$categoria->id}}" {{($categoria->id == $corpus->categoria_id) ? 'selected' : ''}}>{{$categoria->nome}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="titulo">Nome</label>
          <input type="text" class="form-control" name="titulo" id="titulo" required value="{{ $corpus->titulo }}">
        </div>
        <div class="form-group">
          <label for="descricao">Descrição</label>
          <textarea class="form-control" id="descricao" name="descricao" required rows="3">{{ $corpus->descricao }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
      </form>
    </div>
  </div>
@endsection
