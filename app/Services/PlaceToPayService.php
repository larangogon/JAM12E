<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PlaceToPayService
{
    private string $baseUrl;
    private string $login;
    private string $secretKey;
    private int $timeout = 30;

    public function __construct()
    {
        $this->baseUrl = config('jam.place_to_pay.url_base');
        $this->login = config('jam.place_to_pay.login');
        $this->secretKey = config('jam.place_to_pay.secret_key');
    }

    public function createSession(
        array $payment,
        array $payer,
        array $instrument = [],
        string $returnUrl = '',
        string $cancelUrl = '',
        string $ipAddress = '',
        string $userAgent = ''
    ): object {
        $payload = [
            'auth' => $this->generateAuth(),
            'payment' => array_merge([
                'allowPartial' => false,
                'skipCvv' => false,
            ], $payment),
            'payer' => array_merge([
                'name' => '',
                'email' => '',
                'document' => '',
                'documentType' => 'CC',
                'mobile' => '',
                'address' => [
                    'street' => '',
                    'city' => '',
                    'state' => '',
                    'postalCode' => '',
                    'country' => 'CO',
                ],
            ], $payer),
            'expiration' => now()->addDays(2)->toIso8601String(),
            'returnUrl' => $returnUrl,
            'cancelUrl' => $cancelUrl ?? $returnUrl,
            'ipAddress' => $ipAddress ?: request()->ip(),
            'userAgent' => $userAgent ?: request()->userAgent(),
            'skipResult' => false,
            'nonce' => bin2hex(random_bytes(16)),
            'redirectUrl' => false,
        ];

        if (!empty($instrument)) {
            $payload['instrument'] = $instrument;
        }

        return $this->post('/api/session', $payload);
    }

    public function getSession(string $requestId): object
    {
        return $this->post("/api/session/{$requestId}", [
            'auth' => $this->generateAuth(),
        ]);
    }

    public function reverse(string $internalReference): object
    {
        return $this->post('/api/reverse', [
            'auth' => $this->generateAuth(),
            'internalReference' => $internalReference,
        ]);
    }

    public function refund(string $internalReference, ?float $amount = null): object
    {
        $payload = [
            'auth' => $this->generateAuth(),
            'internalReference' => $internalReference,
        ];

        if ($amount !== null) {
            $payload['amount'] = [
                'currency' => 'COP',
                'total' => $amount,
            ];
        }

        return $this->post('/api/refund', $payload);
    }

    private function post(string $endpoint, array $data): object
    {
        try {
            $url = $this->baseUrl . $endpoint;

            $response = Http::timeout($this->timeout)
                ->connectTimeout(10)
                ->post($url, $data);

            $this->logRequest($endpoint, $data, $response);

            if (!$response->successful()) {
                throw new \Exception(
                    "PlaceToPay API Error ({$response->status()}): {$response->body()}",
                    $response->status()
                );
            }

            $decoded = json_decode($response->body());

            if (isset($decoded->status) && $decoded->status->status === 'FAILED') {
                Log::warning('PlaceToPay API returned FAILED status', [
                    'endpoint' => $endpoint,
                    'response' => $decoded,
                ]);
            }

            return $decoded;
        } catch (\Exception $e) {
            Log::error('PlaceToPay API request failed', [
                'endpoint' => $endpoint,
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);

            throw $e;
        }
    }

    private function generateAuth(): array
    {
        $seed = now()->toIso8601String();
        $nonce = bin2hex(random_bytes(16));

        return [
            'login' => $this->login,
            'seed' => $seed,
            'nonce' => base64_encode($nonce),
            'tranKey' => base64_encode(hash('sha1', $nonce . $seed . $this->secretKey, true)),
        ];
    }

    private function logRequest(string $endpoint, array $data, $response): void
    {
        $safeData = $data;
        if (isset($safeData['auth']['tranKey'])) {
            $safeData['auth']['tranKey'] = '***';
        }

        Log::debug('PlaceToPay API Request', [
            'endpoint' => $endpoint,
            'request' => $safeData,
            'response_status' => $response->status(),
        ]);
    }
}
