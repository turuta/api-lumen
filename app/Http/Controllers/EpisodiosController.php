<?php

namespace App\Http\Controllers;

use App\Episodio;

class EpisodiosController extends BaseController
{
    public function __construct()
    {
        $this->model = Episodio::class;
    }

    public function buscaPorSerie(int $serieId)
    {
        $episodios = Episodio::query()
            ->where('serie_id', $serieId)
            ->paginate();

        //$episodios = Episodio::find($serieId);

        return $episodios;
    }
}
