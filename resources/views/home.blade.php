@extends('layouts.app')

@section('content')
 <!--Service Area Start-->
        <div class="skills-area section-bottom-padding">
            <div class="container"> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <h1>NOSSAS <span>AVENTURAS</span></h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row hidden-md hidden-lg">
                    <h2>Acompanhe nossas aventuras pelas trilhas, campings e praias por todo estado de Santa Catarina</h2>
                </div>

                <div class="row hidden-xs hidden-sm">
                    <div class="col-md-4 col-sm-6">
                        <div class="single-skill-item">
                            <div class="single-skill-icon">
                                <div class="skill-bg"></div>
                                <div class="skill-border-left"></div>
                                <img alt="" src="{{ asset('img/icon/skill-1.png') }}" class="primary-img">
                                <img alt="" src="{{ asset('img/icon/skill-1-hover.png') }}" class="secondary-img">
                                <div class="skill-border-right"></div>
                            </div>
                            <div class="single-skill-text">
                                <h4>TRILHAS</h4>
                                <h3><span class="counter">{{ $totais['trilha'] }}</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="single-skill-item low">
                            <div class="single-skill-icon">
                                <div class="skill-bg"></div>
                                <div class="skill-border-left"></div>
                                <img alt="" src="{{ asset('img/icon/skill-2.png') }}" class="primary-img">
                                <img alt="" src="{{ asset('img/icon/skill-2-hover.png') }}" class="secondary-img">
                                <div class="skill-border-right"></div>
                            </div>
                            <div class="single-skill-text">
                                <h4>GALERIAS</h4>
                                <h3><span class="counter">{{ $totais['galeria'] }}</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 hidden-sm">
                        <div class="single-skill-item medium">
                            <div class="single-skill-icon">
                                <div class="skill-bg"></div>
                                <div class="skill-border-left"></div>
                                <img alt="" src="{{ asset('img/icon/skill-3.png') }}" class="primary-img">
                                <img alt="" src="{{ asset('img/icon/skill-3-hover.png') }}" class="secondary-img">
                                <div class="skill-border-right"></div>
                            </div>
                            <div class="single-skill-text">
                                <h4>CAMPING</h4>
                                <h3><span class="counter">{{ $totais['camping'] }}</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        @include('trilhas.componentes.ultima_trilha');
        
         <!--Best Sell Area Start-->
        <div class="best-sell-area section-padding" style="background: #ffffff;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <h1>AVENTURAS <span>FAVORITAS</span></h1>
                            </div>    
                            <p>As trilhas favoritas na opinião dos nossos aventureiros. <br/> Escolha sua preferida você também!</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">

                        <div class="row">
                            <div class="best-sell-slider carousel-style-one">

                                @foreach($preferidas->slice(1) as $key => $trilha)

                                    @php 
                                        $img = ($trilha->foto->where('id_tipo_foto_tfo',1)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',1)->first()->nm_path_fot : 'padrao.jpg';
                                        $alt = ($trilha->foto->where('id_tipo_foto_tfo',1)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',1)->first()->dc_alt_fot : 'Miniatura da Trilha';
                                    @endphp

                                    @if($key%2 == 1)
                                        <div class="col-md-3">
                                    @endif

                                        <div class="hover-effect">
                                            <p class="titulo_trilha_destaque">{{ $trilha->nm_trilha_tri }}</p>
                                            <div class="box-hover">
                                                <a href="{{ url($trilha->ds_url_tri) }}">
                                                    <img src="{{ asset('img/trilhas/destaque-pequena/'.$img) }}" alt="{{ $alt }}">
                                                    <span>{{ $trilha->cidade->nm_cidade_cde }}</span>
                                                </a>
                                            </div>
                                        </div>

                                    @if($key%2 == 0)
                                        </div>
                                    @endif

                                @endforeach
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="box-publicidade-destaque">
                                    <span>PUBLICIDADE</span>
                                </div>
                            </div> 
                        </div>
                    </div>

                    @php
                        $trilha_destaque = $preferidas->shift();
                        $img_destaque = ($trilha_destaque->foto->where('id_tipo_foto_tfo',2)->first()) ? $trilha_destaque->foto->where('id_tipo_foto_tfo',2)->first()->nm_path_fot : 'padrao.jpg';
                        $alt_destaque = ($trilha_destaque->foto->where('id_tipo_foto_tfo',2)->first()) ? $trilha_destaque->foto->where('id_tipo_foto_tfo',2)->first()->dc_alt_fot : 'Miniatura da Trilha';
                    @endphp

                    <div class="col-md-6 hidden-sm">
                        <p class="titulo_trilha_destaque">{{ $trilha_destaque->nm_trilha_tri }}</p>
                        <a href="{{ url($trilha_destaque->ds_url_tri) }}"><img src="{{ asset('img/trilhas/destaque-principal/'.$img_destaque) }}" alt="{{ $alt_destaque }}"></a>
                    </div>
                    
                </div>
            </div>
        </div>
    
        <div class="partner-area section-bottom-padding">
            <div class="container">          
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <br/><br/><h1>INFORMES <span>PUBLICITÁRIOS</span></h1>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="row publicidade">
                    
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="box-publicidade">
                            <span>PUBLICIDADE</span>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="box-publicidade">
                            <span>PUBLICIDADE</span>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="box-publicidade">
                            <span>PUBLICIDADE</span>
                        </div>
                    </div>             

                </div>
            </div>
        </div>
@endsection