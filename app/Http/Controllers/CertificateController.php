<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function validateCode(Request $request)
    {
        $code = $request->query('codigo', 'MAR-2026-98421');
        $certificate = Certificate::where('codigo', $code)->first();

        return view('certificados.validar', compact('certificate', 'code'));
    }
}
