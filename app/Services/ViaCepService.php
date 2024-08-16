<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaCepService
{
    public function getAddressFromCep(string $cep): array
    {
        $response = Http::withOptions(['verify' => false])->get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->failed() || isset($response['erro'])) {
            throw new \Exception('CEP inválido ou não encontrado.');
        }

        return $response->json();
    }
}
