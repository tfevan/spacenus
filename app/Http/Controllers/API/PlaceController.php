<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Validator;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\API\PlaceRequest;

class PlaceController extends Controller
{
	/**
     * Get a list of nearby places based on the provided coordinates. 
     */
    public function places(PlaceRequest $request) : JsonResponse
    {
    	$response = Http::withUrlParameters([
		    'endpoint' => 'https://api.tomtom.com',
		    'page' => 'search',
		    'version' => '2',
		    'topic' => 'nearbySearch',
		    'ext' => '.json',
		    'key' => config('app.tomtom_api_key'),
		    'lat' => $request->lat,
		    'lon' => $request->long,
		    'radius' => 5000,
		])->accept('application/json')->get('{+endpoint}/{page}/{version}/{topic}/{ext}?key={key}&lat={lat}&lon={lon}&radius={radius}');

    	if ($response->status() == 200) {
	    	return response()->json([
	    		'success' => true,
	    		'data' => $response->object(),
	    	], 200);

    	} elseif ($response->status() == 400) {
    		return response()->json([
	    		'success' => false,
	    		'data' => [],
	    		'message' => 'Bad Request : One or more parameters were incorrectly specified.'
	    	], 400);

    	} elseif ($response->status() == 403) {
    		return response()->json([
	    		'success' => false,
	    		'data' => [],
	    		'message' => 'Forbidden'
	    	], 403);

    	} elseif ($response->status() == 405) {
    		return response()->json([
	    		'success' => false,
	    		'data' => [],
	    		'message' => 'Method Not Allowed'
	    	], 405);

    	} elseif ($response->status() == 429) {
    		return response()->json([
	    		'success' => false,
	    		'data' => [],
	    		'message' => 'Too Many Requests : The API Key is over QPS (Queries per second).'
	    	], 429);

    	} else {
    		return response()->json([
	    		'success' => false,
	    		'data' => [],
	    		'message' => 'Server Error : The service was unable to process your request.'
	    	], 500);
    	}
    }
}
