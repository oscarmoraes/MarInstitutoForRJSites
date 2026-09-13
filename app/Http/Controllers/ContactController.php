<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:100',
            'message' => 'required|string',
        ]);

        $message = ContactMessage::create([
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['subject'] ?? 'GERAL',
            'message' => $validated['message'],
            'status' => 'NOVA',
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Sua mensagem foi enviada com sucesso! Em breve nossa equipe retornará seu contato.',
                'data' => $message,
            ]);
        }

        return redirect()->back()->with('success', 'Sua mensagem foi enviada com sucesso! Em breve nossa equipe retornará seu contato.');
    }
}
