<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Services\TokenService; // Custom Service

class ApiController extends Controller
{
    protected $tokenService;
    const API_URL = "https://ws.artelibre.gr/";

    public function __construct(TokenService $tokenService) {
        $this->tokenService = $tokenService;
    }

    public function getShippingAreas(Request $request) {
        // Generate the token
        $token = $this->tokenService->generateToken();

        // Make the API call to artelibre's API
        $response = Http::withToken($token)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post(self::API_URL, [
            'action' => 'getShippingAreas',
        ]);

        // // Log for debug
        // Log::info('API Response', [
        //     'Status' => $response->status(),
        //     'Body' => $response->body(),
        // ]);

        // Check if the request was successful
        if ($response->successful()) {
            $data = $response->json();
            return response()->json($data);
        } else {
            // Optionally handle errors - log them, return a custom error message, etc.
            // Adjust the status code and error handling as needed
            return response()->json(['error' => 'Failed to retrieve shipping areas'], 500);
        }

    }

    public function getShippingMethods(Request $request) {
        // Generate the token
        $token = $this->tokenService->generateToken();

        // Make the API call to artelibre's API
        $response = Http::withToken($token)
        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post(self::API_URL, [
            'action' => 'getTShippingMethods',
        ]);

        // Check if the request was successful
        if ($response->successful()) {
            $data = $response->json();
            return response()->json($data);
        } else {
            // Optionally handle errors - log them, return a custom error message, etc.
            // Adjust the status code and error handling as needed
            return response()->json(['error' => 'Failed to retrieve shipping methods'], 500);
        }

    }


    public function getShippingCost(Request $request) {
        // Generate the token
        $token = $this->tokenService->generateToken();
        
        // TODO: Add the ability to set the products in the body request and then write a documentation

        // Prepare your payload
        $payload = [
            "action" => "getShippingCost",
            "location" => [
                "postal" => "11147",
                "area" => "ΓΑΛΑΤΣΙ"
            ],
            "products" => [
                ["sku" => "14210001", "qty" => 1],
                ["sku" => "14560028", "qty" => 1]
            ]
        ];

        // Make the POST request
        $response = Http::withHeaders([
            'Accept' => 'application/json', // Expecting JSON in response
            'Authorization' => 'Bearer ' . $token, // Use this if you need to send a token
        ])->post(self::API_URL, $payload); // Directly pass the array, Laravel will encode it to JSON

         // Check if the request was successful
         if ($response->successful()) {
            $data = $response->json();
            return response()->json($data);
        } else {
            // Optionally handle errors - log them, return a custom error message, etc.
            // Adjust the status code and error handling as needed
            return response()->json(['error' => 'Failed to retrieve shipping cost'], 500);
        }
    }
}
