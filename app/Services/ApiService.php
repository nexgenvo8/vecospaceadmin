<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('API_URL'); // store base url in config
    }

    public function getData($endpoint, $params = [])
    {

        try {

            $response = Http::get($this->baseUrl . $endpoint, $params);

            if ($response->successful()) {
                return $response->json();
            }

            return [
                'error' => true,
                'message' => $response->body()
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }


    public function postJson($endpoint, $data = [])
    {
        $url = $this->baseUrl . $endpoint; // Construct full URL

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($url, $data); // Send POST request with JSON data

            if ($response->successful()) {
                return $response->json();
            }

            return [
                'error' => true,
                'message' => $response->body(), // API returned an error
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }




    public function postData($endpoint, $data = [])
    {
        try {
            $response = Http::post($this->baseUrl . $endpoint, $data);

            if ($response->successful()) {
                return [
                    'error' => false,
                    'data' => $response->json()
                ];
            }

            return [
                'error' => true,
                'message' => $response->body()
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }

}
