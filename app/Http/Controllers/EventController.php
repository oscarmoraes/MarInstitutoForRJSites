<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\EventSchedule;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        //$featuredEvent deve ser o proximo evento futuro, ou o evento mais recente se não houver eventos futuros
        $featuredEvent = Event::where('ativo', true)
            ->whereDate('data_evento', '>=', now()->toDateString())
            ->orderBy('data_evento', 'ASC')
            ->first();

        if (!$featuredEvent) {
            $featuredEvent = new Event();
            $featuredEvent->id = 0;
        }

        $events = Event::where('ativo', true)
            ->whereDate('data_evento', '>=', now()->toDateString())
            ->when($featuredEvent, fn ($q) => $q->where('id', '!=', $featuredEvent->id))
            ->orderBy('data_evento', 'ASC')
            ->get();

        return view('cursos-e-palestras', compact('featuredEvent', 'events'));
    }

    public function show($slug = 'simposio-mar-2026')
    {
        $event = Event::with(['galleries' => function ($query) {
            $query->where('status', 'published')
                ->where(function ($query) {
                    $query->whereNull('published_at')
                        ->orWhere('published_at', '<=', now());
                })
                ->with(['photos' => fn ($query) => $query->orderBy('sort_order')]);
        }])->where('slug', $slug)->first();

        if (! $event) {
            $event = Event::with(['galleries' => function ($query) {
                $query->where('status', 'published')
                    ->where(function ($query) {
                        $query->whereNull('published_at')
                            ->orWhere('published_at', '<=', now());
                    })
                    ->with(['photos' => fn ($query) => $query->orderBy('sort_order')]);
            }])->first();
        }
        $registeredCount = $event ? $event->registrations()->where('status', 'confirmado')->count() : 0;

        $schedules = EventSchedule::where('event_id', $event->id)->orderBy('ordem', 'ASC')->get();

        return view('curso-detalhe', compact('event', 'registeredCount', 'schedules'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'nome' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'oab_uf' => 'nullable|string|max:50',
        ]);

        $registration = EventRegistration::create([
            'event_id' => $validated['event_id'],
            'nome' => $validated['nome'],
            'whatsapp' => $validated['whatsapp'],
            'email' => $validated['email'] ?? null,
            'oab_uf' => $validated['oab_uf'] ?? null,
            'status' => 'confirmado',
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Inscrição realizada com sucesso!',
                'registration' => $registration,
            ]);
        }

        return redirect()->back()->with('success', 'Inscrição efetuada com sucesso!');
    }
}
