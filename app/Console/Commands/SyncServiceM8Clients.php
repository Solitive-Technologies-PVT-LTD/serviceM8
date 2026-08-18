<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SyncServiceM8Clients extends Command
{
    protected $signature = 'servicem8:sync-clients';

    protected $description = 'Fetch companies from ServiceM8 and insert new ones into servicem8_clients, skipping existing records.';

    public function handle()
    {
        $this->info('Starting ServiceM8 client sync...');

        $baseUrl =rtrim(config('servicem8.base_url'), '/'); // adjust to your actual config key
        $apiKey  =  config('servicem8.api_key');  // adjust to your actual config key

        $cursor   = '-1';
        $inserted = 0;
        $skipped  = 0;
        $page     = 0;

        do {
            $page++;

            $response = Http::withHeaders([
                'X-API-Key' => $apiKey,
            ])->get("{$baseUrl}/company.json", [
                'cursor' => $cursor,
            ]);

            if ($response->failed()) {
                Log::error('ServiceM8 sync failed on page ' . $page, [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                $this->error("Failed to fetch clients on page {$page}: HTTP {$response->status()}");
                return Command::FAILURE;
            }

            $clients = $response->json() ?? [];
            
            foreach ($clients as $client) {
                $uuid = $client['uuid'] ?? null;

                if (!$uuid) {
                    continue;
                }

                $affected = DB::table('servicem8_clients')->insertOrIgnore([
                    'uuid'              => $uuid,
                    'name'              => $client['name'] ?? null,
                    'abn_number'        => $client['abn_number'] ?? null,
                    'address_street'    => $client['address_street'] ?? null,
                    'address_city'      => $client['address_city'] ?? null,
                    'address_state'     => $client['address_state'] ?? null,
                    'address_postcode'  => $client['address_postcode'] ?? null,
                    'address_country'   => $client['address_country'] ?? null,
                    'billing_address'   => $client['billing_address'] ?? null,
                    'website'           => $client['website'] ?? null,
                    'is_individual'     => $client['is_individual'] ?? false,
                    'fax_number'        => $client['fax_number'] ?? null,
                    'badges'            => $client['badges'] ?? null,
                    'tax_rate_uuid'     => $client['tax_rate_uuid'] ?? null,
                    'billing_attention' => $client['billing_attention'] ?? null,
                    'payment_terms'     => $client['payment_terms'] ?? null,
                    'active'            => $client['active'] ?? true,
                    'edit_date'         => $client['edit_date'] ?? null,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]);

                $affected > 0 ? $inserted++ : $skipped++;
            }

            $this->line("Page {$page}: fetched " . count($clients) . " records. Next cursor: " . ($response->header('x-next-cursor') ?: 'NONE'));

            $cursor = $response->header('x-next-cursor') ?: null;
            
        } while (!empty($cursor));

        $this->info("Sync complete. Inserted: {$inserted}, Skipped (already existed): {$skipped}");

        return Command::SUCCESS;
    }
}