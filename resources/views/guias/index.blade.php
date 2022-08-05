@extends('layouts.blog')
@section('content')
        <div class="blog-post-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center">
                            <div class="title-border">
                                <br/><br/><h1>Guias e Condutores</h1>
                            </div>    
                        </div>
                    </div>                          
                </div>
                @foreach($guias as $key => $guia)
                    <div class="row">
                        <div class="col-md-3">
                            @if($guia->nm_path_logo_gui)
                                <img class="circle-image mb-3 mb-md-0" src="{{ asset('img/guias/'.$guia->nm_path_logo_gui) }}" alt="Logo Guia {{ $guia->nm_guia_gui }}">
                            @else
                                <img class="circle-image mb-3 mb-md-0" src="{{ asset('img/guias/default.png') }}" alt="Logo Guia {{ $guia->nm_guia_gui }}">
                            @endif
                        </div>
                        <div class="col-md-9">
                            <h4>{{ $guia->nm_guia_gui }}</h4>
                            <p><i class="fa fa-instagram"></i> <a href="{{ url("guia/perfil/instagram", $guia->id_guia_gui) }}">{{ $guia->nm_instagram_gui }}</a></p>
                            <p><strong>Cidade</strong>: {{ $guia->origem->nm_cidade_cde }}</p>
                            <p><strong>Contato</strong>: {{ ($guia->fone) ? $guia->fone->nu_fone_fon : '' }}</p>
                            <p>
                                {{ $guia->dc_biografia_gui }}
                            </p>
                        </div>
                    </div>
                    @if($key < count($guias) - 1)
                        <hr/>   
                    @endif                 
                @endforeach
            </div>
        </div>
@endsection