<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;


class EventController extends Controller
{
    public function index()
    {
        $search = request('search');
        if ($search == null) {
            $search = '';
        }
        $events = Event::search($search);

        // if ($search) {
        //     // $events = Event::where([
        //     //     ['title', 'like', '%' . $search . '%'],
        //     // ])->get();
        //     // $events = Event::search($search)->get();
        //     $events = Event::search($search);
        // } else {
        //     // $events = Event::all();
        //     $events = Event::search("");
        // }

        $events = $events->paginate(10);
        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create()
    {
        return view('events.create');
    }

    private function resizeImage($request)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            return Image::make($requestImage)
                ->fit(780, 520, function ($constrait) {
                    $constrait->aspectRatio();
                });
        }
        return null;
    }

    private function saveImage($fileExtension, $resizedImg)
    {
        if ($resizedImg == null) {
            return '';
        }

        $fileName = Str::uuid() . '.' . $fileExtension;
        $result = $resizedImg->save(public_path('img/events/' . $fileName), 100);

        return $result ? $fileName : "";
    }

    public function store(Request $request)
    {
        $event = new Event;
        $event->title = $request->title;
        $event->city = $request->city;
        $event->description = $request->description;
        $event->private = $request->private;
        $event->date = $request->date;

        $event->items = [];
        if ($request->items) {
            $event->items = $request->items;
        }

        $resizedImg = $this->resizeImage($request);
        $fileName = $this->saveImage($request->image->extension(), $resizedImg);
        if ($fileName == '' || $resizedImg == null) {
            return redirect('/')->with('msg', 'Erro ao criar Evento!');
        }

        $user = auth()->user();
        $event->user_id = $user->id;
        $event->image = $fileName;
        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);

        return view(
            'events.show',
            [
                'event' => $event,
            ]
        );
    }

    public function dashboard()
    {
        $user = auth()->user();
        $events = $user->events;
        $eventsAsParticipant = $user->eventsAsParticipant;

        return view(
            'events.dashboard',
            [
                'events' => $events,
                'eventsAsParticipant' => $eventsAsParticipant
            ]
        );
    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete();
        return redirect('/dashboard')->with('msg', 'Evento Excluído com sucesso');
    }

    public function edit($id)
    {
        $user = auth()->user();
        $event = Event::findOrFail($id);
        if ($user->id != $event->user_id) {
            return redirect('/dashboard');
        }
        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request)
    {
        $event = Event::findOrFail($request->id);

        $data = $request->all();
        $resizedImg = $this->resizeImage($request);
        $fileName = $this->saveImage($request->image->extension(), $resizedImg);
        if ($fileName == '' || $resizedImg == null) {
            return redirect('/')->with('msg', 'Erro ao Editar Evento');
        }

        $previewsImgPath = 'img/events/' . $event->image;

        $hasImg = File::exists($previewsImgPath);
        if ($hasImg) {
            File::delete($previewsImgPath);
        }

        $data['image'] = $fileName;

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento Editado com sucesso');
    }

    private function hasUserAlreadyJoined($user, $eventId)
    {
        return $user
            ->eventsAsParticipant()
            ->where('event_id', $eventId)
            ->exists();
    }

    public function joinEvent($id)
    {
        $user = auth()->user();
        $event = Event::findOrFail($id);

        if ($this->hasUserAlreadyJoined($user, $id)) {
            return redirect('/events/' . $event->id)->with('msg', 'Já estás a participar do evento: ' . $event->title);
        }

        $user->eventsAsParticipant()->attach($id);
        return redirect('/dashboard')->with('msg', 'Tua presença está confirmada ao evento ' . $event->title);
    }

    public function leaveEvent($id)
    {
        $user = auth()->user();
        $user->eventsAsParticipant()->detach($id);
        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Tua presença foi removida do evento: ' . $event->title);
    }

}