<?php

namespace App\Http\Controllers;

use App\Models\OfficialDocument;
use Illuminate\Http\Request;

class OfficialDocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = OfficialDocument::query();

        $categoriaSelecionada = $request->input('categoria');
        if (! empty($categoriaSelecionada) && $categoriaSelecionada !== 'todas') {
            $query->where('categoria', $categoriaSelecionada);
        }

        $anoSelecionado = $request->input('ano');
        if (! empty($anoSelecionado) && $anoSelecionado !== 'todos') {
            $query->whereYear('data_publicacao', $anoSelecionado);
        }

        $busca = $request->input('busca');
        if (! empty($busca)) {
            $query->where(function ($q) use ($busca) {
                $q->where('titulo', 'like', "%{$busca}%")
                  ->orWhere('resumo', 'like', "%{$busca}%")
                  ->orWhere('numero', 'like', "%{$busca}%");
            });
        }

        $documents = $query->orderBy('data_publicacao', 'desc')->get();

        $categories = OfficialDocument::select('categoria')->distinct()->pluck('categoria');
        $years = OfficialDocument::selectRaw('YEAR(data_publicacao) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('notas-e-atos-oficiais', compact(
            'documents',
            'categories',
            'years',
            'categoriaSelecionada',
            'anoSelecionado',
            'busca'
        ));
    }
}
