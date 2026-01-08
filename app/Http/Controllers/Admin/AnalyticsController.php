<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        // 1. Determine Range
        $range = $request->query('range', '7d');
        
        // Variables
        $labels = [];
        $requests = [];
        $visitors = [];
        $zoneId = env('CLOUDFLARE_ZONE_ID');
        $token = env('CLOUDFLARE_API_TOKEN');

        // 2. LOGIC SPLIT: 24 Hours (Hourly Data) vs Days (Daily Data)
        
        if ($range === '24h') {
            // --- 24 HOUR MODE (Hourly Data) ---
            
            // Cloudflare 'date_geq' expects Y-m-d even for hourly queries
            // We ask for data starting from yesterday to cover the last 24h
            $startDate = Carbon::now()->subDays(1)->format('Y-m-d');
            $endDate = Carbon::now()->format('Y-m-d');
            
            // KEY FIX: We request 'datetime' dimension to get hourly splits
            $query = <<<'GRAPHQL'
                query ($zoneTag: string, $dateStart: Date, $dateEnd: Date) {
                  viewer {
                    zones(filter: {zoneTag: $zoneTag}) {
                      httpRequests1hGroups(
                        orderBy: [datetime_ASC]
                        limit: 50
                        filter: {date_geq: $dateStart, date_leq: $dateEnd}
                      ) {
                        dimensions { datetime }
                        sum { requests }
                        uniq { uniques }
                      }
                    }
                  }
                }
            GRAPHQL;

            $node = 'httpRequests1hGroups';
            $dateKey = 'datetime'; // Field to read from response
            $labelFormat = 'H:i';  // Display as "14:00"

        } else {
            // --- 7 DAYS / 30 DAYS MODE (Daily Data) ---
            
            $days = ($range === '30d') ? 30 : 7;
            $startDate = Carbon::now()->subDays($days)->format('Y-m-d');
            $endDate = Carbon::now()->format('Y-m-d');

            $query = <<<'GRAPHQL'
                query ($zoneTag: string, $dateStart: Date, $dateEnd: Date) {
                  viewer {
                    zones(filter: {zoneTag: $zoneTag}) {
                      httpRequests1dGroups(
                        orderBy: [date_ASC]
                        limit: 100
                        filter: {date_geq: $dateStart, date_leq: $dateEnd}
                      ) {
                        dimensions { date }
                        sum { requests }
                        uniq { uniques }
                      }
                    }
                  }
                }
            GRAPHQL;

            $node = 'httpRequests1dGroups';
            $dateKey = 'date';    // Field to read from response
            $labelFormat = 'M d'; // Display as "Oct 25"
        }

        // 3. EXECUTE
        if (App::environment('local')) {
            // Fake Data Logic for Localhost
            $limit = ($range === '24h') ? 24 : (($range === '30d') ? 30 : 7);
            for ($i = $limit; $i >= 0; $i--) {
                $d = ($range === '24h') ? Carbon::now()->subHours($i) : Carbon::now()->subDays($i);
                $labels[] = $d->format($labelFormat);
                $requests[] = rand(100, 1000); 
                $visitors[] = rand(50, 300); 
            }
        } else {
            // Real API Call
            try {
                $response = Http::withToken($token)->post('https://api.cloudflare.com/client/v4/graphql', [
                    'query' => $query,
                    'variables' => [
                        'zoneTag' => $zoneId,
                        'dateStart' => $startDate,
                        'dateEnd' => $endDate,
                    ],
                ]);

                $data = $response->json();
                $analytics = $data['data']['viewer']['zones'][0][$node] ?? [];

                // Filter Loop: Cloudflare might return more hours than we need (e.g., 48h). 
                // We trim it to strictly the last 24h if in 24h mode.
                $cutoff = Carbon::now()->subHours(24);

                foreach ($analytics as $point) {
                    $dateValue = $point['dimensions'][$dateKey]; // 'datetime' or 'date'
                    $carbonDate = Carbon::parse($dateValue);

                    // For 24h mode, skip data older than 24 hours
                    if ($range === '24h' && $carbonDate->lt($cutoff)) {
                        continue;
                    }

                    $labels[] = $carbonDate->format($labelFormat);
                    $requests[] = $point['sum']['requests'];
                    $visitors[] = $point['uniq']['uniques'];
                }

            } catch (\Exception $e) {
                // Log error if needed
            }
        }

        return view('admin.analytics', compact('labels', 'requests', 'visitors', 'range'));
    }
}