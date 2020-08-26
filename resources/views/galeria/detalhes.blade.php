@extends('layouts.blog')
@section('content')
        <div class="portfolio-area portfolio-two">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title title-two text-center">
                            <div class="title-border" style="margin-top: 50px;">
                                <h1>GALERIA <span>{{ $galeria->nm_galeria_gal }}</span></h1>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($galeria->itens as $foto)
                        <img src="{{ asset('img/galerias/fotos/'.$foto->nm_path_fot) }}" alt="{{ $foto->dc_alt_foto }}">
                    @endforeach
                </div>
                <br/>
            </div>
        </div>
@endsection