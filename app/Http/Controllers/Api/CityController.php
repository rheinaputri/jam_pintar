<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Search cities by query string.
     */
    public function index(Request $request)
    {
        $q = (string) $request->query('q', '');
        $q = trim($q);
        if ($q === '') {
            return response()->json([], 200);
        }

        $cacheKey = 'cities_search_' . md5(strtolower($q));

        $results = Cache::remember($cacheKey, 60 * 60, function() use ($q) {
            // prefer prefix matches for autocomplete and return compact fields
            return City::whereRaw('LOWER(name) LIKE ?', [strtolower($q)."%"])
                ->orderByRaw("CASE WHEN LOWER(name) LIKE ? THEN 0 ELSE 1 END", [strtolower($q).'%'])
                ->limit(10)
                ->get(['id','name','province']);
        });

        return response()->json($results);
    }

    /**
     * Backwards-compatible search returning `city_name` field
     */
    public function searchCity(Request $request)
    {
        $q = (string) $request->query('q', '');
        $q = trim($q);
        if ($q === '') {
            return response()->json([], 200);
        }

        $results = City::where('name', 'like', "%{$q}%")
            ->orderByRaw("CASE WHEN LOWER(name) LIKE ? THEN 0 ELSE 1 END", [strtolower($q).'%'])
            ->limit(10)
            ->get(['id','regency_code','name','type','province','lat','lon'])
            ->map(function($c){
                return [
                    'id' => $c->id,
                    'city_name' => $c->name,
                    'province' => $c->province,
                    'regency_code' => $c->regency_code,
                ];
            });

        return response()->json($results);
    }
}
