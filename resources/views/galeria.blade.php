@extends('layouts.blog')
@section('content')
        <div class="portfolio-area portfolio-two">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title title-two text-center">
                            <div class="title-border" style="margin-top: 50px;">
                                <h1>NOSSAS <span>GALERIAS</span></h1>
                            </div>    
                            <p>Nossas trilhas rendem belas fotos, dos mais diversos tipos! Então criamos as galerias temáticas, para organizar e trazer as mais legais para vocês. <br/>Escolha a que mais gosta e aproveite a paisagem!</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($galerias as $galeria)

                    @php 
                        $img = ($galeria->fotos and $galeria->fotos->where('id_tipo_foto_tfo',8)->first()) ? $galeria->fotos->where('id_tipo_foto_tfo',8)->first()->nm_path_fot : 'padrao.jpg';
                        $alt = ($galeria->fotos and $galeria->fotos->where('id_tipo_foto_tfo',8)->first()) ? $galeria->fotos->where('id_tipo_foto_tfo',8)->first()->dc_alt_fot : 'Foto da Trilha';
                    @endphp

                        <div class="col-md-3 col-sm-4">
                            <div class="single-portfolio">
                                <a href="#"><img src="{{ asset('img/trilhas/galeria-capa/'.$img) }}" alt=""></a>
                                <div class="portfolio-text effect-bottom">
                                    <h4><a href="#">{{ $galeria->nm_galeria_gal }}</a></h4>
                                    <p>{!! $galeria->ds_galeria_gal !!}</p>
                                    <div class="portfolio-link">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection