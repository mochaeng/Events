@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')
    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Crie o seu evento: </h1>
        <form action="/events" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="img">Banner do Evento:</label>
                <input type="file" id="image" name="image" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="title">Evento:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nome do Evento">
            </div>
            <div class="form-group">
                <label for="title">Data do Evento:</label>
                <input type="date" class="form-control" id="date" name="date" placeholder="Data do Evento">
            </div>
            <div class="form-group">
                <label for="city">Cidade:</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Nome da Cidade">
            </div>
            <div class="form-group">
                <label for="private">O evento é privado?</label>
                <select name="private" id="private" class="form-control">
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Descreva seu evento:</label>
                <textarea id="description" name="description" class="form-control"></textarea>
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

            <input id="submit-button" type="submit" class="btn btn-primary" value="Submeter Evento">
        </form>
    </div>
@endsection
