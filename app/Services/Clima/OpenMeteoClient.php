<?php

namespace App\Services\Clima;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

class OpenMeteoClient
{
    /** @var Client */
    private $http;

    public function __construct(Client $http = null)
    {
        $this->http = $http ?: new Client([
            'timeout' => (int) config('clima.open_meteo.timeout', 30),
            'http_errors' => false,
        ]);
    }

    /**
     * Consulta previsão diária (7 dias) + condições atuais.
     *
     * @param float $latitude
     * @param float $longitude
     * @return array
     */
    public function forecast($latitude, $longitude)
    {
        $params = [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'timezone' => config('clima.timezone', 'America/Sao_Paulo'),
            'forecast_days' => 7,
            'current' => implode(',', [
                'temperature_2m',
                'relative_humidity_2m',
                'weather_code',
                'cloud_cover',
                'wind_speed_10m',
                'wind_gusts_10m',
            ]),
            'daily' => implode(',', [
                'weather_code',
                'temperature_2m_max',
                'temperature_2m_min',
                'precipitation_sum',
                'precipitation_probability_max',
                'wind_speed_10m_max',
                'wind_gusts_10m_max',
                'uv_index_max',
                'sunrise',
                'sunset',
            ]),
            'wind_speed_unit' => 'kmh',
        ];

        return $this->get(config('clima.open_meteo.forecast_url'), $params);
    }

    /**
     * Consulta histórico diário para agregação mensal.
     *
     * @param float $latitude
     * @param float $longitude
     * @param string $startDate Y-m-d
     * @param string $endDate Y-m-d
     * @return array
     */
    public function archive($latitude, $longitude, $startDate, $endDate)
    {
        $params = [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'timezone' => config('clima.timezone', 'America/Sao_Paulo'),
            'daily' => implode(',', [
                'temperature_2m_mean',
                'temperature_2m_max',
                'temperature_2m_min',
                'precipitation_sum',
                'relative_humidity_2m_mean',
                'wind_speed_10m_mean',
            ]),
            'wind_speed_unit' => 'kmh',
        ];

        return $this->get(config('clima.open_meteo.archive_url'), $params);
    }

    /**
     * @param string $url
     * @param array $params
     * @return array
     */
    private function get($url, array $params)
    {
        try {
            $response = $this->http->get($url, [
                'query' => $params,
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);
        } catch (GuzzleException $e) {
            throw new RuntimeException('Falha de conexão com Open-Meteo: ' . $e->getMessage(), 0, $e);
        }

        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        $data = json_decode($body, true);

        if ($status !== 200 || !is_array($data)) {
            $reason = is_array($data) && isset($data['reason']) ? $data['reason'] : $body;
            throw new RuntimeException("Open-Meteo respondeu HTTP {$status}: {$reason}");
        }

        return $data;
    }
}
