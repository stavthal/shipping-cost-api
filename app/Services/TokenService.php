<?php

namespace App\Services;

class TokenService
{
    public function generateToken()
    {
        // Retrieve username and password from .env file
        $username = env('API_USERNAME');
        $password = env('API_PASSWORD');

        // Concatenate username and password separated by a colon
        $credentials = "{$username}:{$password}";

        // Base64 encode the credentials to generate the token
        $token = base64_encode($credentials);

        return $token;
    }
}