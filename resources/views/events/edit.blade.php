@extends('layouts.main')

@section('title', 'Edição de ' . $event->title)

@section('content')
    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>A editar: {{ $event->title }} </h1>
        <form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="img">Banner do Evento:</label>
                <input type="file" id="image" name="image" class="form-control-file">
                <img class="img-preview" src="{{ Vite::asset('./public/img/events/') }}{{ $event->image }}"
                    alt="{{ $event->title }}" />
            </div>
            <div class="form-group">
                <label for="title">Evento:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nome do Evento"
                    value="{{ $event->title }}">
            </div>
            <div class="form-group">
                <label for="title">Data do Evento:</label>
                <input type="date" class="form-control" id="date" name="date"
                    value="{{ date('Y-m-d', strtotime($event->date)) }}">
            </div>
            <div class="form-group">
                <label for="city">Cidade:</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Nome da Cidade"
                    value="{{ $event->city }}">
            </div>
            <div class="form-group">
                <label for="private">O evento é privado?</label>
                <select name="private" id="private" class="form-control">
                    <option value="0" {{ $event->private ? '' : 'selected' }}>Não</option>
                    <option value="1" {{ $event->private ? 'selected' : '' }}>Sim</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Descreva seu evento:</label>
                <textarea id="description" name="description" class="form-control">{{ $event->description }}
                </textarea>
            </div>

            <div class="form-group">
                <label>Adicione itens de infraestrutura:</label>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="cadeiras"> Cadeiras
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="palco"> Palco
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="cerveja gratis"> Cerveja grátis
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="open food"> Open Food
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="brindes"> Brindes
                </div>
            </div>

            <input id="submit-button" type="submit" class="btn btn-primary" value="Editar Evento">
        </form>
    </div>
@endsection
