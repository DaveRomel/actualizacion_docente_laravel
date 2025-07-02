<?php namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class MateriaApiService
{
    protected $fastApiBaseUrl = 'http://192.168.0.11:4000/api';
    protected $cacheDuration = 1; // Segundos

    public function getContagemInscritos($materia_id)
    {
        if (is_null($materia_id)) {
            return 'N/A (ID Matéria Inválido)';
        }
        $cacheKey = "conteo_inscritos_materia_{$materia_id}";
        
        return Cache::remember($cacheKey, $this->cacheDuration, function () use ($materia_id) {
            try {
                $apiToken = session('api_token');
                $response = Http::withToken($apiToken)->get("{$this->fastApiBaseUrl}/inscripcion/contar_inscritos_por_materia/{$materia_id}");
                if ($response->successful()) {
                    $data = $response->json();
                    if (is_numeric($data)) return (int) $data;
                    if (is_array($data) && isset($data['count']) && is_numeric($data['count'])) return (int) $data['count'];
                    Log::warning("Formato invalido {$materia_id}.", ['response' => $data]);
                    return 'N/A';
                } else {
                    Log::error("Error en el API {$materia_id}. Status: " . $response->status());
                    return 'Erro';
                }
            } catch (\Exception $e) {
                Log::error("Excepción API conteo matéria {$materia_id}: " . $e->getMessage());
                return 'Erro';
            }
        });
    }
}
