<?php

namespace App\Services;

use App\Serie;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Scalar\String_;

class CriadorDeSerie
{
    public function criarSerie(String $nomeSerie, int $qtdTemporadas, int $epPorTemporada): Serie
    {

        DB::beginTransaction();
        $serie = Serie::create(['nome' => $nomeSerie]);
        $this->criaTemporadas( $qtdTemporadas, $serie, $epPorTemporada );
        DB::commit();

        return $serie;
    }

    /**
     * @param int $qtdTemporadas
     * @param $serie
     * @param int $epPorTemporada
     */
    private function criaTemporadas(int $qtdTemporadas, $serie, int $epPorTemporada): void
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create( ['numero' => $i] );

            $this->criaEpisodios( $epPorTemporada, $temporada );

        }
    }

    /**
     * @param int $epPorTemporada
     * @param $temporada
     */
    private function criaEpisodios(int $epPorTemporada, $temporada): void
    {
        for ($j = 1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create( ['numero' => $j] );
        }
    }
}
