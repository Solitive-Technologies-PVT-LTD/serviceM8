<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ServiceM8WebhookController extends Controller
{
    /**
     * Handle incoming webhook from ServiceM8
     * This is a test endpoint to see what ServiceM8 sends
     */
    public function handle(Request $request)
    {
        // Log all incoming webhook data for testing
        Log::info('ServiceM8 Webhook Received', [
            'headers' => $request->headers->all(),
            'body' => $request->all(),
            'raw_body' => $request->getContent(),
            'ip' => $request->ip(),
            'timestamp' => now()->toDateTimeString()
        ]);

        // Store webhook payload in storage for debugging
        $filename = 'webhooks/servicem8-' . now()->format('Y-m-d-His') . '.json';
        Storage::put($filename, json_encode([
            'headers' => $request->headers->all(),
            'body' => $request->all(),
            'raw_body' => $request->getContent(),
            'ip' => $request->ip(),
            'timestamp' => now()->toDateTimeString()
        ], JSON_PRETTY_PRINT));

        // Return success response to ServiceM8
        return response()->json([
            'status' => 'success',
            'message' => 'Webhook received and logged',
            'timestamp' => now()->toDateTimeString()
        ], 200);
    }

    /**
     * Test endpoint to verify webhook URL is accessible
     */
    public function test()
    {
        return response()->json([
            'status' => 'ok',
            'message' => 'ServiceM8 webhook endpoint is accessible',
            'endpoint' => route('servicem8.webhook'),
            'timestamp' => now()->toDateTimeString()
        ], 200);
    }
}
