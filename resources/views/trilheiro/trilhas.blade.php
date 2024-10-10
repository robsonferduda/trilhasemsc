@extends('layouts.template')

@section('content')
    <div class="block-header">
        <div class="row">
            <div class="col-lg-5 col-md-8 col-sm-12">
                <h2>Trilheiros</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-map"></i> Trilheiros</li>
                    <li class="breadcrumb-item">Trilhas</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card planned_task">                             
                <div class="body">
                    @include('layouts.mensagens')                   
                        <form action="{{ url('trilheiro/privado/trilhas') }}" enctype="multipart/form-data" method="post" id="form-trilheiro">
                            @csrf
                            <div class="row clearfix" style="margin-left: 20px">
                                @foreach($cidades as $cidade) 
                                    <h5>{{ $cidade->nm_cidade_cde }}</h5>
                                    @foreach($cidade->trilhas as $trilha)
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" name="trilhas[]" value="{{ $trilha->id_trilha_tri }}"  {!! in_array($trilha->id_trilha_tri, $trilhasTrilheiro) ? 'checked' : '' !!} class="check_trilha">
                                                <span>{{ $trilha->nm_trilha_tri}}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>   
                            <div style="text-align: center; margin-top:15px; ">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                            </div>
                        </form>                  
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection