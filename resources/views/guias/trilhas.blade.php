@extends('layouts.template')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
                <h2>Guias e Condutores</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-id-card"></i> Guias e Condutores</li>
                    <li class="breadcrumb-item">Trilhas</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card planned_task">
                <div class="header no-padding-bottom">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <h2>Escolha 5 trilhas de sua preferência:</h2>
                        </div>
                    </div>
                </div>
             
                <div class="body">
                    @include('layouts.mensagens')
                    <form action="{{ url('guia-e-condutores/privado/trilhas') }}" enctype="multipart/form-data" method="post" id="form-guia">
                        @csrf
                        <div class="row clearfix" style="margin-left: 20px">
                            @foreach($cidades as $cidade) 
                                <h5>{{ $cidade->nm_cidade_cde }}</h5>
                                @foreach($cidade->trilhas as $trilha)
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="trilhas[]" value="{{ $trilha->id_trilha_tri }}"  {!! in_array($trilha->id_trilha_tri, $trilhasGuia) ? 'checked' : '' !!} class="check_trilha">
                                            <span>{{ $trilha->nm_trilha_tri}}</span><br><span class="text-danger">{{ isset($qtdGuiasPorTrilha[$trilha->id_trilha_tri])  ?  $qtdGuiasPorTrilha[$trilha->id_trilha_tri].' guia(s) vinculado(s) a essa trilha.' :'Nenhum guia está vinculado a essa trilha.' }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>   
                        <div style="text-align: center; margin-top:15px; ">
{{--                            <a href="{{ url('admin/listar-trilhas') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>--}}
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {      
            let check_trilha = document.getElementsByClassName('check_trilha');
            Array.from(check_trilha).forEach(function(element) {
	            element.addEventListener('change', function() {
	            
	                if (this.checked) {

                        var checkboxes = document.querySelectorAll('input[name="trilhas[]"]:checked')
                        if(checkboxes.length > 5) {
                            alert('Limite de trilhas excedido!');
	                        this.checked = false;
                        }
                        
	                } 

	            });
	        });
            
        });
    </script>
@endsection