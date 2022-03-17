<?php

use App\Regency;
use App\Village;
use App\District;
use App\Province;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user', 'Api\UserController@index');

Route::get('/uplevel/{student}', 'Api\UpLevelController@index');
Route::put('/uplevel', 'Api\UpLevelController@update');

Route::get('/provinces', function (){
    $data = Province::all();

    $response = [
        'message' => 'Berhasil Mengambil Data Provinsi',
        'code' => 200,
        'data' => $data,
    ];

    try {
        return response()->json($response, Response::HTTP_OK);
    } catch (\Throwable $th) {
        return response()->json($th, 500);
    }   
});

Route::get('/regencies', function (Request $request){
    $data = Regency::where('province_id', $request['province'])->get();

    $response = [
        'message' => 'Berhasil Mengambil Data Kabupaten',
        'code' => 200,
        'data' => $data,
    ];

    try {
        return response()->json($response, Response::HTTP_OK);
    } catch (\Throwable $th) {
        return response()->json($th, 500);
    }   
});

Route::get('/districts', function (Request $request){
    $data = District::where('regency_id', $request['regency'])->get();

    $response = [
        'message' => 'Berhasil Mengambil Data Kecamatan',
        'code' => 200,
        'data' => $data,
    ];

    try {
        return response()->json($response, Response::HTTP_OK);
    } catch (\Throwable $th) {
        return response()->json($th, 500);
    }   
});

Route::get('/villages', function (Request $request){
    $data = Village::where('district_id', $request['district'])->get();

    $response = [
        'message' => 'Berhasil Mengambil Data Desa',
        'code' => 200,
        'data' => $data,
    ];

    try {
        return response()->json($response, Response::HTTP_OK);
    } catch (\Throwable $th) {
        return response()->json($th, 500);
    }   
});


