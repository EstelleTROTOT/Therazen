<?php

class RouteService
{
    private string $apiKey;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/openrouteservice.php';

        $this->apiKey = $config['api_key'];
    }

    public function geocodeAddress(string $address): ?array
    {
        $url =
            'https://api.openrouteservice.org/geocode/search?' .
            http_build_query([
                'api_key' => $this->apiKey,
                'text' => $address,
                'size' => 1
            ]);

        $response = file_get_contents($url);

        if (!$response) {
            return null;
        }

        $data = json_decode($response, true);
    
        if (
            empty($data['features'][0]['geometry']['coordinates'])
        ) {
            return null;
        }

        return [
            'longitude' => $data['features'][0]['geometry']['coordinates'][0],
            'latitude'  => $data['features'][0]['geometry']['coordinates'][1]
        ];
    }

    public function calculateDistance(
        float $startLat,
        float $startLng,
        float $endLat,
        float $endLng
    ): ?array {

        $url = 'https://api.openrouteservice.org/v2/directions/driving-car';

        $payload = [
            'coordinates' => [
                [$startLng, $startLat],
                [$endLng, $endLat]
            ]
        ];

        $ch = curl_init($url);

      curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,

    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false,

    CURLOPT_HTTPHEADER => [
        'Authorization: ' . $this->apiKey,
        'Content-Type: application/json'
    ],

    CURLOPT_POSTFIELDS => json_encode($payload)
]);

        $response = curl_exec($ch);

if ($response === false) {
    curl_close($ch);
    return null;
}

curl_close($ch);
if (!$response) {
    return null;
}

        $data = json_decode($response, true);

        if (
            empty(
                $data['routes'][0]['summary']
            )
        ) {
            return null;
        }

        return [
            'distance_km' =>
                round(
                    $data['routes'][0]['summary']['distance'] / 1000,
                    1
                ),

            'duration_minutes' =>
                round(
                    $data['routes'][0]['summary']['duration'] / 60
                )
        ];
    }
}