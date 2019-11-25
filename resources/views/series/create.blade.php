@extends('layout')

@section('cabecalho')
    Adicionar Série
@endsection

@section('conteudo')
    @include('erros', ['erros' => $errors])

    <form method="post">
        @csrf
        <div class="row">
            <div class="col col-7">
                <label for="nome">Nome*</label>
                <input type="text" class="form-control" name="nome" id="nome" />
            </div>

            <div class="col col-2">
                <label for="qtd_temporadas">Nº de Temporadas*</label>
                <input type="text" class="form-control" name="qtd_temporadas" id="qtd_temporadas" />
            </div>

            <div class="col col-3">
                <label for="ep_por_temporada">Nº Ep. por Temporadas*</label>
                <input type="text" class="form-control" name="ep_por_temporada" id="ep_por_temporada" />
            </div>
        </div>

        <button class="btn btn-primary mt-2">Adicionar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

@endsection
