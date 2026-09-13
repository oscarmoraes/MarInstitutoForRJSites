<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberCardResource;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberApiController extends Controller
{
    public function card(Request $request)
    {
        $matricula = $request->query('matricula', '#2026-9842');
        $member = Member::where('matricula', $matricula)->first() ?? Member::first();

        if (! $member) {
            return response()->json([
                'success' => false,
                'message' => 'Associado não localizado.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new MemberCardResource($member),
        ]);
    }
}
