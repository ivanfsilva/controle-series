<?php

namespace App\Services;

use App\Episodio;
use App\Serie;
use App\Temporada;
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie
{
    public function removerSerie(int $SerieId): string
    {
        $nomeSerie = '';
        DB::transaction(function () use ($SerieId, &$nomeSerie) {
            $serie = Serie::find($SerieId);
            $nomeSerie = $serie->nome;

            $this->removerTemporadas( $serie );
            $serie->delete();

        });

        return $nomeSerie;
    }

    /**
     * @param $serie
     */
    private function removerTemporadas(Serie $serie): void
    {
        $serie->temporadas->each( function (Temporada $temporada) {
            $this->removerEpisodios( $temporada );
            $temporada->delete();
        } );
    }

    /**
     * @param Temporada $temporada
     */
    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios->each( function (Episodio $episodio) {
            $episodio->delete();
        } );
    }
}
