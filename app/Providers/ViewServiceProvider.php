<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Services\MateriaApiService; // Importe o serviço

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @param \App\Services\MateriaApiService $materiaApiService
     * @return void
     */
    public function boot(MateriaApiService $materiaApiService) // Injete o MateriaApiService
    {
        $viewsParaContagem = [
            'actualizacion_docente.computacion.confirmacion',
            'actualizacion_docente.computacion.computacion',
            'actualizacion_docente.fisica.confirmacion',
            'actualizacion_docente.fisica.fisica',
            'actualizacion_docente.matematicas.confirmacion',
            'actualizacion_docente.matematicas.matematicas',
        ];

        View::composer($viewsParaContagem, function ($view) use ($materiaApiService) {
            $viewName = $view->getName(); // Obtém o nome da view (ex: 'actualizacion_docente.computacion.principal')
            $materia_id = null;

            if (str_contains($viewName, '.computacion.')) {
                $materia_id = 1;
            } elseif (str_contains($viewName, '.fisica.')) {
                $materia_id = 2;
            } elseif (str_contains($viewName, '.matematicas.')) {
                $materia_id = 3;
            }

            $contagem = 'N/D'; // Valor padrão
            if ($materia_id !== null) {
                $contagem = $materiaApiService->getContagemInscritos($materia_id);
            }

            $view->with('contagem_inscritos', $contagem); // Disponibiliza a variável para a view
        });
    }
}