<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class GeoController extends Controller
{
    public function getGeoData(Request $request)
    {
        $request->validate([
            'latlng' => 'required|string',
        ]);

        $latlng = $request->input('latlng');
        $apiKey = env('GOOGLE_MAPS_API_KEY');
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$latlng}&key={$apiKey}";

        $response = Http::get($url);

        return response()->json($response->json());
    }
}
