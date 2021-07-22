@extends('layouts.blog')

@section('pageTitle','Lista de Trilhas')
@section('description', 'Guia de trilhas e camping em Santa Catarina, trazendo informações de localização, trajetos e grau de dificuldade para quem quer conhecer e desfrutar das praias, serras e montanhas desse belo estado do Sul do Brasil' )
@section('content')

<!--Adventures Grid Start-->
<div id="lista" class="adventures-grid section-padding list">
    <div class="container">
        <div class="shop-item-filter">
            <!-- Horizontal Tela Detalhes Trilha -->
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-1229685353625953"
                data-ad-slot="7739149091"
                data-ad-format="auto"
                data-full-width-responsive="true"></ins>
            <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            <br />
            <form action="{{url('trilhas/#lista')}}" id="banner-searchbox" class="form-search-trilha">
                <div class="row" style="padding-top: 5px;">
                    <div class="col-lg-2 col-md-12 col-sm-12">
                        <p>Mostrando {{ $trilhas->count() }} Trilha(s) - Página {{ $trilhas->currentPage()  }} de {{ $trilhas->lastPage()  }}</p>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                        <div class="adventure-cat box-small">
                            <select name="cidade" class="search-adventure">
                                <option value="">Selecione a Cidade</option>
                                @foreach($cidades as $cidade)
                                <option {{ $cidade_p == stringToStringSeo($cidade->nm_cidade_cde) || old('cidade') == stringToStringSeo($cidade->nm_cidade_cde) ? 'selected': ''}} value="{{stringToStringSeo($cidade->nm_cidade_cde)}}">{{$cidade->nm_cidade_cde}}</option>
                                @endforeach
                               
                            </select>
                        </div>
                    </div>    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="adventure-cat box-small">
                            <select name="nivel" class="search-adventure">
                                <option value="">Selecione o Nível</option>
                                @foreach($niveis as $nivel)
                                <option {{ $nivel_p == stringToStringSeo($nivel->dc_nivel_niv) || old('nivel') == stringToStringSeo($nivel->dc_nivel_niv) ? 'selected': ''}} value="{{stringToStringSeo($nivel->dc_nivel_niv)}}">{{$nivel->dc_nivel_niv}}</option>
                                @endforeach
                               
                            </select>
                        </div>
                    </div>    
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">    

                        <div class="box-busca-aventura-list">
                            <button type="button" style="margin-top: 0px;"  class="btn btn-light btn-busca-aventura-list btn-search-trilha">Buscar Aventura</button>
                        </div>
                    </div>               
                </div>        
            </form>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            @if($trilhas->count() > 0)
                @foreach($trilhas as $trilha)
                    @php 
                        $foto = $trilha->foto->where('id_tipo_foto_tfo',7)->first();
                        $img = !empty($foto->nm_path_fot) ? $foto->nm_path_fot : 'padrao.jpg';
                        $alt = !empty($foto->dc_alt_fot) ? $foto->dc_alt_fot : 'Foto';
                        
                    @endphp

                    <div class="col-md-12">
                        <div class="single-list-item">
                            <div class="row">
                                <div class="col-md-4 col-sm-5">
                                    <div class="adventure-img">
                                        <a href="{{ url($trilha->ds_url_tri) }}"><img src="{{ asset('img/trilhas/busca/'.$img) }} " alt="{{$alt}}"></a>
                                        
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-7 margin-left-list">
                                    <div class="adventure-list-container">
                                        <div class="adventure-list-text">
                                            <h1><a href="{{ url($trilha->ds_url_tri) }}">{{$trilha->nm_trilha_tri}}</a></h1>
                                            <h2 class='cidade-list' ><a href="{{ url(stringToStringSeo($trilha->cidade->nm_cidade_cde).'/trilhas/#lista') }}">{{$trilha->cidade->nm_cidade_cde}}</a></h2>
                                            <p>
                                                {!! nl2br(substr($trilha->ds_trilha_tri, 0, strpos($trilha->ds_trilha_tri, chr(10) ) - 1)) !!}
                                            </p>
                                            <div class="list-buttons">
                                                <a href="{{ url($trilha->ds_url_tri) }}" class="button-one button-blue">LER MAIS</a>                                        
                                            </div>
                                        </div>
                                        <div class="adventure-list-image">
                                            <div class="image-top">
                                                <img class="icone-nivel" src="{{ asset('img/trilhas/nivel/'.$trilha->nivel->dc_icone_niv) }}" alt="Ícone indicador de trilha com nível {{ ucfirst(trans($trilha->nivel->dc_nivel_niv)) }}">
                                            </div>
                                            <h2>{{ $trilha->nivel->dc_nivel_niv }}</h2>
                                            <div style="height: 150px; display: inline-block;">
                                                
                                            </div>                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>                    
                @endforeach                
                <div class="clearfix"></div>
                <div class="pagination-content">
                    <div class="pagination-button">
                        <ul class="pagination">
                            <li><a href="{{ $trilhas->previousPageUrl().'#lista' }}"><i class="fa fa-angle-left"></i></a></li>
                            @for ($i = 1; $i <= $trilhas->lastpage(); $i++)
                                <li {!! $trilhas->currentPage() ==  $i ? 'class="current"' : ' '  !!}><a href="{{ $trilhas->url($i).'#lista' }}">{{ $i }}</a></li>
                            @endfor                            
                            <li><a href="{{ $trilhas->nextPageUrl().'#lista' }}"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
                <br />
                <!-- Horizontal Tela Detalhes Trilha -->
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-1229685353625953"
                    data-ad-slot="7739149091"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            @else
                <div class='col-md-12 msg-list-empty-trilhas'>
                    @if(!empty($termo))
                        <p>Nenhuma trilha encontrada com esse nome: <strong>{{$termo}}</strong></p>                        
                    @else
                        @if(!empty($cidade_p))
                            <p>Ainda não fizemos nenhuma trilha desse nível no local escolhido!</p>
                        @else
                            <p>Ainda não fizemos nenhuma trilha desse nível!</p>
                        @endif                        
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection