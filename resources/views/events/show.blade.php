@extends('layouts.main')
@section('title', $event->title)

@section('extra-import')
    @vite(['resources/js/showPage.js'])
@endsection

@section('content')
    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img class="card-img-top" class="img-fluid" src="{{ Vite::asset('./public/img/events/') }}{{ $event->image }}"
                    alt="{{ $event->title }}" />
            </div>
            <div id="info-container" class="col-md-6">
                <h1>{{ $event->title }}</h1>
                <p class="event-city">
                    <i class="fa-solid fa-location-dot"></i>
                    {{ $event->city }}
                </p>
                <p class="events-participants">
                    <i class="fa-solid fa-user-group"></i>
                    {{ count($event->users) }}
                    K participantes
                </p>
                <p class="event-owner">
                    <i class="fa-solid fa-star"></i>
                    {{ $event->user->name }}
                </p>

                <form action="/events/join/{{ $event->id }}" method="POST" id="make-pressence">
                    @csrf
                    <a href="/events/join/{{ $event->id }}" class="btn btn-primary" id="pressence-submit">Confirmar
                        Presença</a>
                </form>

                <h3 id="title-items">O evento conta com:</h3>
                <ul id="items-list">
                    @if ($event->items != null)
                        @foreach ($event->items as $item)
                            <li class="event-list-item">
                                <i class="fa-solid fa-hashtag"></i>
                                {{ $item }}
                            </li>
                        @endforeach
                    @else
                        <p>Não há itens para esse evento.</p>
                    @endif
                </ul>
            </div>
            <div class="col-md-12" id="description-container">
                <h3>Sobre o Evento:</h3>
                <p class="event-description">
                    {{ $event->description }}
                </p>
            </div>
        </div>
    </div>
@endsection
