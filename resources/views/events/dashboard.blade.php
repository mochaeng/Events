@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Meus Eventos:</h1>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-events-container">
        @if (count($events) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <td scope="col">#</td>
                        <td scope="col">Nome</td>
                        <td scope="col">Participantes</td>
                        <td scope="col">Ações</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                            <td>{{ count($event->users) }}</td>
                            <td>
                                <a href="events/edit/{{ $event->id }}" class="btn btn-info edit-btn">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Editar
                                </a>
                                <form action="/events/{{ $event->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn">
                                        <i class="fa-solid fa-trash"></i>
                                        Deletar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você ainda não possui eventos, <a href="/events/create">criar evento</a> </p>
        @endif
    </div>

    <div class="col-md-10 offset-md-1 dashboard-partipanting-container">
        <h1>Eventos que estais a participar:</h1>
    </div>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
        @if (count($eventsAsParticipant) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <td scope="col">#</td>
                        <td scope="col">Nome</td>
                        <td scope="col">Participantes</td>
                        <td scope="col">Ações</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventsAsParticipant as $event)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                            <td>{{ count($event->users) }}</td>
                            <td>
                                <form action="/events/leave/{{ $event->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn">
                                        <i class="fa-solid fa-person-circle-xmark"></i>
                                        Remover Pressença
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Ainda não estais a participar em nehum evento.<a href="/">Veja mais</a></p>
        @endif
    </div>
@endsection
