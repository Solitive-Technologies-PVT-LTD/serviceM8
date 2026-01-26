<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ServiceM8ApiController extends Controller
{
    private $apiKey;
    private $baseUrl = 'https://api.servicem8.com/api_1.0';

    public function __construct()
    {
        $this->apiKey = config('services.servicem8.api_key');
    }

    /**
     * Test API connection and fetch basic data
     */
    public function testConnection()
    {
        try {
            // Test API connection by fetching companies (customers)
            $response = Http::withHeaders([
                'X-api-key' => $this->apiKey,
                'Accept' => 'application/json',
            ])->get($this->baseUrl . '/company.json');

            if ($response->successful()) {
                $data = $response->json();
                
                Log::info('ServiceM8 API Test Success', [
                    'status' => $response->status(),
                    'data_count' => is_array($data) ? count($data) : 0,
                    'sample' => is_array($data) && count($data) > 0 ? $data[0] : null
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'ServiceM8 API connection successful',
                    'status_code' => $response->status(),
                    'data_count' => is_array($data) ? count($data) : 0,
                    'sample_data' => is_array($data) && count($data) > 0 ? $data[0] : null,
                    'full_response' => $data
                ], 200);
            } else {
                Log::error('ServiceM8 API Test Failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return response()->json([
                    'status' => 'error',
                    'message' => 'ServiceM8 API connection failed',
                    'status_code' => $response->status(),
                    'error' => $response->body()
                ], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('ServiceM8 API Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Exception occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Fetch jobs from ServiceM8
     */
    public function fetchJobs()
    {
        try {
            $response = Http::withHeaders([
                'X-api-key' => $this->apiKey,
                'Accept' => 'application/json',
            ])->get($this->baseUrl . '/job.json');

            if ($response->successful()) {
                $jobs = $response->json();
                
                return response()->json([
                    'status' => 'success',
                    'count' => is_array($jobs) ? count($jobs) : 0,
                    'jobs' => $jobs
                ], 200);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch jobs',
                'status_code' => $response->status(),
                'error' => $response->body()
            ], $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Fetch invoices from ServiceM8
     */
    public function fetchInvoices()
    {
        try {
            $response = Http::withHeaders([
                'X-api-key' => $this->apiKey,
                'Accept' => 'application/json',
            ])->get($this->baseUrl . '/invoice.json');

            if ($response->successful()) {
                $invoices = $response->json();
                
                return response()->json([
                    'status' => 'success',
                    'count' => is_array($invoices) ? count($invoices) : 0,
                    'invoices' => $invoices
                ], 200);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch invoices',
                'status_code' => $response->status(),
                'error' => $response->body()
            ], $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
