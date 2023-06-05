<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Validator;
use Auth;

class AuthController extends Controller
{
	/**
     * Register method through API
     */
    public function register(Request $request) : JsonResponse
    {
    	$validator = Validator::make($request->all(), [
    		'name' => 'required|max:255',
    		'email' => 'required|email|unique:users|max:255',
    		'password' => 'required|max:255',
    		'confirm_password' => 'required|same:password',
    	]);

    	if ($validator->fails()) {
    		return response()->json([
    			'success' => false,
    			'data' => [],
    			'message' => $validator->errors(),
    		], 400);
    	}

    	$user = User::create([
		    'name' => $request->name,
		    'email' => $request->email,
		    'password' => bcrypt($request->password),
		]);

    	$data['token'] = $user->createToken('MyApp')->plainTextToken;
    	$data['name'] = $user->name;

    	$response = [
    		'success' => true,
    		'data' => $data,
    		'message' => 'User register successfully.',
    	];

    	return response()->json($response, 200);
    }

}
