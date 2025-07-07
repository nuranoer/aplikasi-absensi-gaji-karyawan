<?php

use Illuminate\Http\Request;
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/karyawan.php';

Route::get('/', function () {
    return to_route('dashboard');
});

Route::get('/reverse-geocode', function (Request $request) {
    $lat = $request->input('lat');
    $lon = $request->input('lon');

    // Panggil Nominatim
    $response = Http::withHeaders([
        'User-Agent' => 'MyLaravelApp'
    ])->get('https://nominatim.openstreetmap.org/reverse', [
                'lat' => $lat,
                'lon' => $lon,
                'format' => 'json',
                'email' => 'developerbackend11@gmail.com'
            ]);

    if ($response->failed()) {
        return response()->json(['error' => 'Failed to fetch data'], 500);
    }

    return $response->json();
})->name('reverse-geocode');