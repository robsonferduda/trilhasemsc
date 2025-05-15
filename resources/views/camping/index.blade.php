@extends('layouts.site')
@section('content')
@include('layouts/partes/header')
    <section class="pt-1 pb-0 mt-2">
        <div class="container mt-n6 position-relative">
            <div class="row mt-sm-0 mt-5">
                <section class="py-5">
                    @if($campings->count() > 0)
                        @if($campings->count() > 1)
                            <h6 class="mt-4">Foram encontradas {{ $campings->count() }} trilhas </h6>
                        @else
                            <h6 class="mt-4">Foi encontrada {{ $campings->count() }} trilha </h6>
                        @endif
                                         
                        @foreach($campings as $key => $camping)
                            <div class="card card-plain card-blog {{ ($key > 0) ? 'mt-5' : 'mt-3' }}">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="card-image position-relative border-radius-lg">
                                            <a href="{{ url($camping->url_cam) }}"><img class="img border-radius-lg" src="{{ $camping->ds_imagem_cam }}" alt="{{ $camping->ds_nome_cam }}"></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7 my-sm-auto mt-3 ms-sm-3">
                                        <h4>
                                            <a href="{{ url($camping->url_cam) }}" class="text-danger text-decoration-underline-none">{{ $camping->ds_nome_cam }}</a>
                                        </h4>
                                        <h6 class="mt-1 mb-1">{{ $camping->cidade->nm_cidade_cde }}</h6>
                                        <p>
                                            {!! nl2br($camping->ds_sinopse_cam) !!}
                                        </p>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 center">
                                                <img src="{{ url('img/icon/'.$camping->tipo->ds_img_tic) }}" alt="Ícone indicador de camping {{ ucfirst(trans($camping->tipo->ds_tipo_tic)) }}" class="img w-60">
                                                <p class="my-auto mx-auto" style="text-align: center; font-weight: bold;">{{ $camping->tipo->ds_tipo_tic }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach 
                    @endif       
                </section>
            </div>
         </div>
    </section>    
@endsection