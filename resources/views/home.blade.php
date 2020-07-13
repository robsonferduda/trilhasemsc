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

                        <div class="sell-text-container">
                            <div class="title-container">
                                <h3>PATROCINADO</h3>
                                <div style="min-height: 130px;">
                                    <h1>ANUNCIE AQUI!</h1>
                                </div>
                            </div>                            
                        </div>

                        <div class="row">
                            <div class="best-sell-slider carousel-style-one">

                                @foreach($preferidas as $key => $trilha)

                                     @php 
                                        $img = ($trilha->foto->where('id_tipo_foto_tfo',1)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',1)->first()->nm_path_fot : 'padrao.jpg';
                                        $alt = ($trilha->foto->where('id_tipo_foto_tfo',1)->first()) ? $trilha->foto->where('id_tipo_foto_tfo',1)->first()->dc_alt_fot : 'Miniatura da Trilha';
                                    @endphp

                                    @if($key%2 == 0)
                                        <div class="col-md-3">
                                    @endif

                                        <div class="hover-effect">
                                            <div class="box-hover">
                                                <a href="{{ url($trilha->ds_url_tri) }}">
                                                    <img src="{{ asset('img/trilhas/destaque-pequena/'.$img) }}" alt="">
                                                    <span>{{ $trilha->nm_trilha_tri }}</span>
                                                </a>
                                            </div>
                                        </div>

                                    @if($key%2 == 1)
                                        </div>
                                    @endif

                                @endforeach
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 hidden-sm">
                        <a href="#">
                            <img src="{{ asset('img/trilhas/destaque-principal/padrao.jpg') }}" alt="">
                        </a>
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
                <div class="row">
                    <div class="partner-carousel carousel-style-two">
                        <div class="col-md-3">
                            <a href="#"><img src="img/brand/1.jpg" alt=""></a>
                        </div>
                        <div class="col-md-3">
                            <a href="#"><img src="img/brand/2.jpg" alt=""></a>
                        </div>
                        <div class="col-md-3">
                            <a href="#"><img src="img/brand/3.jpg" alt=""></a>
                        </div>
                        <div class="col-md-3">
                            <a href="#"><img src="img/brand/4.jpg" alt=""></a>
                        </div>
                        <div class="col-md-3">
                            <a href="#"><img src="img/brand/1.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection