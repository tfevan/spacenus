<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\RegisterRequest;
use App\Http\Requests\API\LoginRequest;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Validator;
use Auth;

class AuthController extends Controller
{
	/**
     * Register method through API
     */
    public function register(RegisterRequest $request) : JsonResponse
    {
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

    /**
     * Login method through API
     */
    public function login(LoginRequest $request) : JsonResponse
    {
    	if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){

    		$user = Auth::user();

    		$data['token'] = $user->createToken('MyApp')->plainTextToken;
	    	$data['name'] = $user->name;

	    	return response()->json([
	    		'success' => true,
	    		'data' => $data,
	    		'message' => 'User login successfully.',
	    	], 200);

    	} else {
    		return response()->json([
    			'success' => false,
    			'message' => 'Unauthorized',
    		], 401);
    	}
    }
}
