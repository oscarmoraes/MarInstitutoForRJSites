<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateApiController extends Controller
{
    public function verify(Request $request, $code)
    {
        $certificate = Certificate::where('codigo', $code)->first();

        if (! $certificate) {
            return response()->json([
                'success' => false,
                'valid' => false,
                'message' => 'Certificado não encontrado no banco de autenticidade do Instituto MAR.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'valid' => true,
            'data' => [
                'codigo' => $certificate->codigo,
                'participante' => $certificate->participante_nome,
                'oab_uf' => $certificate->oab_uf,
                'evento' => $certificate->evento_titulo,
                'carga_horaria' => $certificate->carga_horaria,
                'data_emissao' => $certificate->data_emissao->format('d/m/Y'),
                'hash_digital' => $certificate->hash_digital,
            ],
        ]);
    }
}
