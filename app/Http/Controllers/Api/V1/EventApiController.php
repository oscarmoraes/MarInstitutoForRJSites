<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class EventApiController extends Controller
{
    public function index()
    {
        $events = Event::where('ativo', true)->orderBy('data_evento', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => EventResource::collection($events),
        ]);
    }

    public function show($id)
    {
        $event = Event::find($id) ?? Event::where('slug', $id)->first();

        if (! $event) {
            return response()->json([
                'success' => false,
                'message' => 'Evento não localizado.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new EventResource($event),
        ]);
    }

    public function register(Request $request, $id)
    {
        $event = Event::find($id) ?? Event::where('slug', $id)->first();

        if (! $event) {
            return response()->json([
                'success' => false,
                'message' => 'Evento não encontrado.',
            ], 404);
        }

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'oab_uf' => 'nullable|string|max:50',
        ]);

        $registration = EventRegistration::create([
            'event_id' => $event->id,
            'nome' => $validated['nome'],
            'whatsapp' => $validated['whatsapp'],
            'email' => $validated['email'] ?? null,
            'oab_uf' => $validated['oab_uf'] ?? null,
            'status' => 'confirmado',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Inscrição realizada com sucesso via App Mobile!',
            'data' => $registration,
        ], 201);
    }
}
