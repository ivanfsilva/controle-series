@extends('layout')

@section('cabecalho')
Séries
@endsection

@section('conteudo')
    @if(!empty($mensagem))
        <div class="alert alert-success">
            {{$mensagem}}
        </div>
    @endif

    <a href="{{ route('form_criar_serie') }}" class="btn btn-dark mb-2">Adicionar</a>

    @foreach($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">

            <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>

            <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                <input type="text" class="form-control" value="{{ $serie->nome }}" />
                <div class="input-group-append">
                    <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                        <i class="fas fa-check"></i>
                    </button>
                    @csrf
                </div>
            </div>

            <span class="d-flex">
                <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $serie->id }})">
                    <i class="class fas fa-edit"></i>
                </button>
                <a href="/series/ {{ $serie->id }}/temporadas" class="btn btn-info btn-sm mr-1">
                    <i class="class fa fa-external-link-alt"></i>
                </a>

                <form method="post" action="/series/{{$serie->id}}"
                        onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($serie->nome) }}?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        <i class="class far fa-trash-alt"></i>
                    </button>
                </form>
            </span>
        </li>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/vendors/all.min.js"></script>

    <script>
        function toggleInput(serieId) {
            const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`);
            const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);

            if (nomeSerieEl.hasAttribute('hidden')) {
                nomeSerieEl.removeAttribute('hidden');
                inputSerieEl.hidden = true;
            } else {
                inputSerieEl.removeAttribute('hidden');
                nomeSerieEl.hidden = true;
            }
        }

        function editarSerie(serieId) {

           let formData = new FormData();
           const nome = document
               .querySelector(`#input-nome-serie-${serieId} > input`)
               .value;

           const token = document.querySelector(`input[name="_token"]`).value;

           formData.append('nome', nome);
           formData.append('_token', token);

            // enviar para uma rota
            const url = `/series/${serieId}/editaNome`;

            // fazer um ama requisição

            fetch(url, {
                body: formData,
                method: 'POST'
            }).then(() =>
            {
                toggleInput(serieId);
                document.getElementById(`nome-serie-${serieId}`).textContent = nome;

            });
        }

    </script>

@endsection
