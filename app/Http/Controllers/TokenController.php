<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TokenController extends Controller
{
    //
    public function generate(Request $request)
    {
        // Retrieve username and password from the request headers
        $username = $request->query('username');
        $password = $request->query('password');

        // Check if both username and password headers are present
        if (!$username || !$password) {
            return Response::json([
                'error' => 'Missing username or password header'
            ], 400); // HTTP 400 Bad Request
        }

        // Concatenate username and password separated by a colon
        $credentials = "{$username}:{$password}";

        // Base64 encode the credentials to generate the token
        $token = base64_encode($credentials);

        // Return the token in a JSON response
        return Response::json(
            ['status' => 200, 'token' => $token, ], 200);
    }
}
