<?php

namespace App\Http\Controllers\Api;

use App\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        $school = School::first();

        $response = [
            'message' => 'Sukses Mendapatkan Data User',
            'data' => $school
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
