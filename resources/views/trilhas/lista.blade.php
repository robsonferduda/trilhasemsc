@extends('layouts.blog')

@section('content')

<!--Adventures Grid Start-->
<div id="lista" class="adventures-grid section-padding list">
    <div class="container">
        <div class="shop-item-filter">
            <form action="{{url('trilhas/#lista')}}" id="banner-searchbox">
                <div class="row" style="padding-top: 5px;">
                    <div class="col-lg-2 col-md-12 col-sm-12">
                        <p>Mostrando {{ $trilhas->count() }} Trilha(s)</p>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
                        <div class="adventure-cat box-small">
                            <select name="cidade" class="search-adventure">
                                <option value="">Selecione a Cidade</option>
                                @foreach($cidades as $cidade)
                                <option {{ $cidade_p == $cidade->cd_cidade_cde || old('cidade') == $cidade->cd_cidade_cde ? 'selected': ''}} value="{{$cidade->cd_cidade_cde}}">{{$cidade->nm_cidade_cde}}</option>
                                @endforeach
                               
                            </select>
                        </div>
                    </div>    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="adventure-cat box-small">
                            <select name="nivel" class="search-adventure">
                                <option value="">Selecione o Nível</option>
                                @foreach($niveis as $nivel)
                                <option {{ $nivel_p == $nivel->id_nivel_niv || old('nivel') == $nivel->id_nivel_niv ? 'selected': ''}} value="{{$nivel->id_nivel_niv}}">{{$nivel->dc_nivel_niv}}</option>
                                @endforeach
                               
                            </select>
                        </div>
                    </div>    
                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">    

                        <div class="box-busca-aventura-list">
                            <button  type="submit" style="margin-top: 0px;"  class="btn btn-light btn-busca-aventura-list">Buscar Aventura</button>
                        </div>
                    </div> 


                {{--    <div class="col-md-2 hidden-sm">    
                        <div class="adventure-cat box-small">
                            <select name="price" class="search-adventure">
                                <option>Price</option>
                                <option>$100-$300</option>
                                <option>$400-$600</option>
                                <option>$700-$800</option>
                                <option>$900-$1000</option>
                            </select>
                        </div>
                    </div>  --}}
              
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
                                        <h2 class='cidade-list' ><a href="{{ url('trilhas/?cidade='.$trilha->cidade->cd_cidade_cde.'#lista') }}">{{$trilha->cidade->nm_cidade_cde}}</a></h2>
                                        <p>
                                            {{ \Illuminate\Support\Str::limit($trilha->ds_trilha_tri, 200, $end='...') }}
                                        </p>
                                        <div class="list-buttons">
                                            <a href="{{ url($trilha->ds_url_tri) }}" class="button-one button-blue">LER MAIS</a>                                        
                                        </div>
                                    </div>
                                    <div class="adventure-list-image">
                                        <div class="image-top">
                                            <img src="img/icon/level.png" alt="">
                                        </div>
                                        <h2>{{ $trilha->nivel->dc_nivel_niv }}</h2>
                                        <div style="height: 162px; width: 300px; display: inline-block;">
                                            
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                @endforeach
            @else
                <div class='col-md-12 msg-list-empty-trilhas'>
                    @if(!empty($cidade_p))
                        <p>Ainda não fizemos nenhuma trilha desse nível no local escolhido!</p>
                    @else
                        <p>Ainda não fizemos nenhuma trilha desse nível!</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
<!--End of Adventures Grid-->
<!--Blog Area Start-->
@include('trilhas.componentes.ultima_trilha');
<!--End of Blog Area-->
@endsection

