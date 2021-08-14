<?php

namespace App\Http\Controllers\Api;

use App\UpLevel;
use App\Helpers\YearHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class UpLevelController extends Controller
{
    public function index($student)
    {
        $status = UpLevel::where('student_id', $student)->where('semester_id', YearHelper::thisSemester()->id)->first();

        $response = [
            'message' => 'Sukses Mendapatkan Status Kenaikan Kelas',
            'data' => $status
        ];

        return response()->json($response, Response::HTTP_OK);      
    }

    public function update(Request $request)
    {
        $status = UpLevel::updateOrCreate(
            ['semester_id' => YearHelper::thisSemester()->id,
            'student_id' => $request->student_id],
            ['status' => $request->status]
        );

        try {
            return response()->json($status, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
           

        

        // $response = [
        //     'message' => 'Sukses Mendapatkan Status Kenaikan Kelas',
        //     'data' => $status
        // ];

        // return response()->json($response, Response::HTTP_OK);      
    }
}
