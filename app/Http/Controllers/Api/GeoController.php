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
    public function getNearbyPlaces(Request $request)
    {
      
        $request->validate([
            'location' => 'required|string',
            'radius' => 'required|integer',
            'type' => 'required|string',
        ]);

        $apiKey = env('GOOGLE_MAPS_API_KEY');
        $location = $request->input('location');
        $radius = $request->input('radius');
        $type = $request->input('type');

        $url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location={$location}&radius={$radius}&type={$type}&key={$apiKey}";

        // Make the HTTP request to the Google Places API
        $response = Http::get($url);

        // Return the response as JSON
        return response()->json($response->json());
    }
}
