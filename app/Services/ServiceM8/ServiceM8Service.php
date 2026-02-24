<?php

namespace App\Services\ServiceM8;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ServiceM8Service
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('servicem8.base_url'), '/');
        $this->apiKey  = config('servicem8.api_key');
    }

    /**
     * Base HTTP client
     */
    protected function client()
    {
        return Http::withHeaders([
            'x-api-key' => $this->apiKey,
            'Accept'    => 'application/json',
        ])->timeout(180);
    }

    /**
     * Handle GET requests
     */
    protected function get(string $endpoint, array $query = [])
    {
        $response = $this->client()->get(
            "{$this->baseUrl}/{$endpoint}",
            $query
        );

        return $this->handleResponse($response, $endpoint);
    }

    /**
     * Handle POST requests
     */
    protected function post(string $endpoint, array $data = [])
    {
        $response = $this->client()->post(
            "{$this->baseUrl}/{$endpoint}",
            $data
        );

        return $this->handleResponse($response, $endpoint);
    }

    /**
     * Unified response handler
     */
    protected function handleResponse($response, string $endpoint)
    {
        if ($response->failed()) {
            if (config('servicem8.logging.enabled')) {
                Log::channel(config('servicem8.logging.channel'))
                    ->error('ServiceM8 API Error', [
                        'endpoint' => $endpoint,
                        'status'   => $response->status(),
                        'body'     => $response->body(),
                    ]);
            }

            throw new \Exception(
                "ServiceM8 API error on {$endpoint}: {$response->status()}"
            );
        }

        return $response->json();
    }

    /*
    |--------------------------------------------------------------------------
    | ServiceM8 API Methods
    |--------------------------------------------------------------------------
    */

    public function getClients(array $params = [])
    {
        return $this->get('company.json', $params);
    }

    public function getCompanyContact(array $params=[])
    {
        return $this->get('companycontact.json', $params);
    }

    public function getStaff(array $params = [])
    {
        return $this->get('staff.json', $params);
    }

    public function getJobs(array $params = [])
    {
        return $this->get('job.json', $params);
    }

    public function getJob(string $uuid)
    {
        return $this->get("job/{$uuid}.json");
    }

    public function getQuotes(array $params = [])
    {
        return $this->get('quote.json', $params);
    }

    public function getInvoices(array $params = [])
    {
        return $this->get('invoice.json', $params);
    }

    public function getJobAttachments(string $jobUuid, string $cursor = '-1', int $limit = 20)
    {
         $params = [
            '$filter' => "related_object eq 'job' and related_object_uuid eq '{$jobUuid}'"
        ];
        
        // Using your existing GET request function
        return $this->get("attachment.json", $params);
    }
    public function getAttachment($uuid, array $params = [])
    {
        return $this->get("dboattachment/{$uuid}.json", $params);
    }
    
    public function getClientAttachments(string $uuid, string $cursor = '-1', int $limit = 20)
    {
         $params = [
            '$filter' => "related_object eq 'cl' and related_object_uuid eq '{$uuid}'"
        ];

        // Using your existing GET request function
        return $this->get("attachment.json", $params);
    }
    

   public function downloadAttachmentStream(string $uuid)
{
    // Build the raw file request
    $response = Http::withHeaders([
        'x-api-key' => $this->apiKey,
        // Don't set Accept: application/json here
    ])->timeout(180)
      ->get("https://api.servicem8.com/api_1.0/Attachment/$uuid.file");

    if ($response->failed()) {
        abort(404, 'Attachment not found.');
    }
    
    return $response->body();
}


    public function downloadAttachment(string $uuid)
    {
        return $this->client()
            ->get("{$this->baseUrl}/attachment/{$uuid}.json")
            ->body();
    }

   
}
