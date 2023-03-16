@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')

    {{-- <img class="banner-img" src="{{ Vite::asset('./resources/images/sandra.webp') }}"> --}}
    <div id="search-container" class="col-md12">
        <h1>Busque um Evento</h1>
        <form action="/" method="GET">
            <input type="search" id="search" name="search" class="form-control" placeholder="Procure por um evento" />
        </form>

    </div>

    <div class="next-events-container">
        @if ($search)
            <h2>A buscar por: <em>{{ $search }}</em> </h2>
        @else
            <h2>Próximos Eventos</h2>
            <p>Veja os eventos dos próximos dias</p>
        @endif
    </div>

    <div id="events-grid" class="row row-cols-3 g-3">
        @if (count($events) == 0 && $search)
            <p>Não foi possivel encontrar nenhum evento com <em>{{ $search }}.</em>
                Clique aqui para <a href="/">ver todos</a>
            </p>
        @elseif (count($events) == 0)
            <h3>Não há eventos :(</h3>
        @endif

        @foreach ($events as $event)
            <div class="col">
                <div class="card card-container">
                    @if ($event->image == '')
                        <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/041.webp" class="card-img-top"
                            alt="Hollywood Sign on The Hill" />
                    @else
                        <img class="card-img-top" src="{{ Vite::asset('./public/img/events/') }}{{ $event->image }}" />
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <div class="card-body-description">
                            <p class="card-text">{{ $event->description }}</p>
                        </div>
                        <em>
                            <p class="event-date">{{ date('d/m/y', strtotime($event->date)) }}</p>
                        </em>
                        <a href="/events/{{ $event->id }}" class="btn btn-primary">Checar Evento</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    {{ $events->links('vendor.pagination.bootstrap-5') }}

@endsection
