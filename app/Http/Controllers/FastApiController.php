<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

class FastApiController extends Controller
{    
    public function get_users(){
        $fastapi=env('FASTAPI');
        $response=Http::get("{$fastapi}user_status_0");

        if($response->successful()){
            $data=$response->json();
            //return response()->json($data);
            return $data;
        }
        else
        {
            return response()->json(['error'=>'error algo salio mal'],500);
        }
    }

}