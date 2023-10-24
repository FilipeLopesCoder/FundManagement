<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funds;

class FundsController extends Controller
{
    //
    public function list(Request $request): JsonResponse
    {
        $data = ['a' => true];

        $headers = $request->header();
        return response()->json($data, 200, $headers);
    }

    public function single(Request $response, string $id): JsonResponse
    {
        $headers = $request->header();
        return response()->json($data, 200, $headers);
    }
}
